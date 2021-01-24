export default {
    baseUrl(path) {
        const url = window.baseURL || '';
        return url + path;
    },
    asset(path) {
        const asset_path = window.assetURL || '';
        return asset_path + path;
    },
    assetUrl(path) {
        const url = window.baseURL+'/files/';
        return url + path;
    },
    toSlug(value) {
        return value.toLowerCase()
            .replace(/-+/g, '')
            .replace(/\s+/g, '-')
            .replace(/[^a-z0-9-]/g, '');
    },
    isActive(value) {
        return value ? 'Active' : 'Inactive';
    },
    isPackage(value) {
        return value ? 'Yes' : 'No';
    },
    isNew(value) {
        return value ? 'Yes' : 'No';
    },
    isStock(value) {
        return value ? 'Available' : 'Not available';
    },
    isMembership(value) {
        return value ? 'Yes' : 'No';
    },
    isVerified(value) {
        return value ? 'Verified' : 'Unverified';
    },
    created(values) {
        if (_.isEmpty(values)) {
            return '';
        }
        return `${values.created_at || ''}
            <br>
            ${this.getFullName(_.get(values, 'created_by.details', {}))}`;
    },
    updated(values) {
        if (_.isEmpty(values)) {
            return '';
        }
        return `${values.updated_at || ''}
            <br>
            ${this.getFullName(_.get(values, 'updated_by.details', {}))}`;
    },
    getFullName(value) {
        if (_.isEmpty(value)) {
            return '';
        }
        return `${value.first_name || ''} ${value.last_name || ''}`;
    },
    async setLang(force = false) {
        if (force || window.localStorage.getItem('lang') === null) {
            const payload = {params: {force}};
            const result = await this.makeApiRequest(`/lang`, 'GET', payload);
            if (result.code === 200) {
                window.localStorage.setItem('lang', JSON.stringify(result.results));
            }
        }
    },
    getLang(key, values = null) {
        let lang = window.localStorage.getItem('lang');
        lang = JSON.parse(lang);
        let trans = _.get(lang, key, '');
        if (values && Object.keys(values).length > 0) {
            for(const attr in values) {
                trans = trans.replace(`:${attr}`, values[attr]);
            }
        }
        return trans;
    },
    getContext(key) {
        return _.get(window, `_context.${key}`,null);
    },
    async makeApiRequest(url, method, payload = {}) {
        let data = null;
        try {
            const result = await axios.request({
                url,
                method,
                params: _.get(payload, 'params', null),
                data: _.get(payload, 'data', null),
                responseType: 'json',
                headers: _.get(payload, 'headers', {
                    'Content-Type': 'Application/json'
                }),
            });
            data = result.data;
            // return data;
        } catch (err) {
            console.log(err.message);
        }
        return data;
    },
    getPages(data) {
        const show_pages = [];
        let start_pages = 0;
        let end_pages = 0;
        let pages = 3;
        const total_page = data.last_page;
        const current_page = data.current_page;
        pages = total_page > pages ? pages : total_page;

        if (current_page <= 1 || pages === total_page) {
            start_pages = 1;
            end_pages = pages;
        }
        else if (current_page === pages) {
            start_pages = Math.ceil(pages / 2);
            end_pages = start_pages + pages - 1;
        }
        else {
            start_pages = current_page - ( current_page < pages ? pages - current_page : current_page - pages );
            start_pages = start_pages <= 0 ? 1 : start_pages;
            end_pages = start_pages + pages - 1;
        }

        if (start_pages <= 0) {
            start_pages = 1;
            end_pages = pages - 1;
        }

        if (end_pages > total_page) {
            end_pages = total_page;
            start_pages = end_pages - ( pages - 1);
        }

        for(start_pages; start_pages <= end_pages; start_pages++){
            show_pages.push(start_pages);
        }

        return show_pages;
    },
    async getDataAction(payload) {
        const url = _.get(payload, 'url', '');
        const params = _.get(payload, 'params', {});
        const result = await this.makeApiRequest(url, 'GET', {params});
        return result;
    },
    async transformToFormData(data, file_Keys) {
        const fileKeys = ['image', 'logo', 'photo', ...file_Keys];
        
        const formData = new FormData();
        _.forEach(data, (value, key) => {
            if (typeof value === 'boolean') {
                value = value ? 1 : 0;
            }
            if (!fileKeys.includes(key) && _.isObject(value)) {
                for (const k in value) {
                    if (value.hasOwnProperty(k)) {
                        if (fileKeys.includes(k)) {
                            formData.append(`${key}[${k}]`, value[k]);
                        } else {
                            if (_.isObject(value[k])) {
                                for (const kk in value[k]) {
                                    if (value[k].hasOwnProperty(kk)) {
                                        // console.log(`${key}[${k}][${kk}]`, value[k][kk]);
                                        formData.append(`${key}[${k}][${kk}]`, value[k][kk]);
                                    }
                                }
                            } else {
                                // console.log(`${key}[${k}]`, value[k]);
                                formData.append(`${key}[${k}]`, value[k]);
                            }
                        }
                    }
                }
            } else {
                // console.log({key, value});
                formData.append(key, value);
            }
        });
        formData.delete('id');
        return formData;
    },
    async postDataAction(payload) {
        const url = _.get(payload, 'url', '');
        const method = _.get(payload, 'method', 'POST');

        if (_.get(payload, 'headers.Content-Type') === 'multipart/form-data') {
            // const data = JSON.parse(JSON.stringify(_.get(payload, 'data', {})));
            const data = _.get(payload, 'data', {});
            const file_Keys = _.get(payload, 'file_keys', []);
            const formData = await this.transformToFormData(data, file_Keys);
            _.set(payload, 'data', formData);
        }

        const result = await this.makeApiRequest(url, method, payload);
        return result;
    },
    async deleteDataAction(payload) {
        const url = _.get(payload, 'url', '');
        const result = await this.makeApiRequest(url, 'DELETE');
        return result;
    },
    async makeOrderItem(product) {
        if (_.isEmpty(product)) {
            return null;
        }
        let variants = [];
        if (!_.isEmpty(_.get(product, 'variants', null))) {
            variants = _.map(product.variants, variant => {
                return {
                    id: variant.id,
                    additional_price: variant.additional_price,
                    variant: `${_.get(variant, 'variant.name', '')} - ${_.get(variant, 'sub_variant.name', '')}`,
                    is_added: false,
                }
            });
        }
        
        let product_price = product.special_price && +product.special_price > 0 ?
          +product.special_price : +product.regular_price;
        product_price = +parseFloat(product_price).toFixed(2) || 0.00;
        
        let vat_amount = product.vat_percent && product.vat_percent > 0 ?
          (product_price * product.vat_percent) / 100 : 0;
        vat_amount = +parseFloat(vat_amount).toFixed(2) || 0.00;
        
        let discount_percent = 0;
        let discount_amount = 0;
        if (_.get(product, 'offer')) {
            discount_percent = _.get(product, 'offer.discount_type', null) === 'percent' ?
              _.get(product, 'offer.discount', null) : 0;
            discount_amount = _.get(product, 'offer.discount_type', null) === 'amount' ?
              _.get(product, 'offer.discount', null) : 0;
            
            if (discount_percent && !discount_amount) {
                discount_amount = (product_price * discount_percent) / 100;
            } else {
                discount_percent = (discount_amount * 100) / product_price;
            }
        }
        discount_percent = +parseFloat(discount_percent).toFixed(2) || 0.00;
        discount_amount = +parseFloat(discount_amount).toFixed(2) || 0.00;
        
        let price = (product_price + vat_amount) - discount_amount;
        price = +parseFloat(price).toFixed(2) || 0.00;
        return {
            product_id: product.id,
            offer_id: _.get(product, 'offer.id', null),
            offer_name: _.get(product, 'offer.name', null),
            product_name: product.name,
            product_code: product.code,
            product_barcode: product.barcode,
            product_unit: _.get(product, 'unit.name', null),
            product_variant: variants,
            product_price: +product_price,
            product_qty: 1,
            discount_percent: +discount_percent,
            discount_amount: +discount_amount,
            vat_percent: +product.vat_percent,
            vat_amount: +vat_amount,
            price: +price,
            sub_total: +price,
            item_lock: false,
        }
    },
    async updateOrderItem(item, qty=null) {
        if (_.isEmpty(item)) {
            return null;
        }
        let product_qty = +item.product_qty;
        product_qty = qty ? +item.product_qty + qty : +item.product_qty;
        product_qty = +product_qty;
        
        let product_price = +parseFloat(item.product_price).toFixed(2) || 0.00;
        let vat_amount = +parseFloat(item.vat_amount).toFixed(2) || 0.00;
        let vat_percent = +parseFloat((vat_amount * 100) / product_price).toFixed(2) || 0.00;
        
        let discount_amount = +parseFloat(item.discount_amount).toFixed(2) || 0.00;
        let discount_percent = +parseFloat((discount_amount * 100) / product_price).toFixed(2) || 0.00;
        console.log({product_price, vat_amount, discount_amount});
        let price = (product_price + vat_amount) - discount_amount;
        price = +parseFloat(price).toFixed(2);
        return {
            ...item,
            vat_percent,
            discount_percent,
            product_qty,
            price,
            sub_total: price * product_qty
        }
    },
    printInvoice(elem){
        var win = window.open('', '');
        var content = '<html><head><title>Invoice</title>' +
          '<link rel="stylesheet" type="text/css" href="'+window.assetURL+'/css/adminlte.min.css" />'+
          '<link rel="stylesheet" type="text/css" href="'+window.assetURL+'/css/style.css" /></head>';
        content += "<body onload=\"window.print(); setTimeout(function(){window.close();}, 1000)\">";
        content += document.getElementById(elem).innerHTML ;
        content += "</body>";
        content += "</html>";
        win.document.write(content);
        win.document.close();
        return true;
    },
};

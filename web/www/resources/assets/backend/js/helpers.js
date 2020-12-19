export default {
    asset(path) {
        const asset_path = window.assetURL || '';
        return asset_path + path;
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
    async makeApiRequest(url, method, payload = {}) {
        let data = null;
        try {
            const result = await axios.request({
                url,
                method,
                params: _.get(payload, 'params', null),
                data: _.get(payload, 'data', null),
                responseType: 'json',
                headers: _.get(payload, 'headers', {}),
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
    async transformToFormData(data) {
        const formData = new FormData();
        _.forEach(data, (value, key) => {
            if (typeof value === 'boolean') {
                value = value ? 1 : 0;
            }
            if (key !== 'image' && _.isObject(value)) {
                for (const k in value) {
                    if (value.hasOwnProperty(k)) {
                        if (_.isObject(value[k])) {
                            for (const kk in value[k]) {
                                if (value[k].hasOwnProperty(kk)) {
                                    console.log(`${key}[${k}][${kk}]`, value[k][kk]);
                                    formData.append(`${key}[${k}][${kk}]`, value[k][kk]);
                                }
                            }
                        } else {
                            console.log(`${key}[${k}]`, value[k]);
                            formData.append(`${key}[${k}]`, value[k]);
                        }
                    }
                }
            } else {
                formData.append(key, value || null);
            }
        }); 
        formData.delete('id');
        return formData;
    },
    async postDataAction(payload) {
        const url = _.get(payload, 'url', '');
        const method = _.get(payload, 'method', '');

        if (_.get(payload, 'headers.Content-Type') === 'multipart/form-data') {
            const data = JSON.parse(JSON.stringify(_.get(payload, 'data', {})));
            const formData = await this.transformToFormData(data);
            console.log(formData);
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
};

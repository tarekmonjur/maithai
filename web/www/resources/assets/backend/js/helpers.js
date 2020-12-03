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
    created(values) {
        return `${values.created_at} <br> ${values.created_by}`;
    },
    updated(values) {
        return `${values.updated_at} <br> ${values.updated_by}`;
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
    async postDataAction(payload) {
        const url = _.get(payload, 'url', '');
        const method = _.get(payload, 'method', '');

        if (_.get(payload, 'headers.Content-Type') === 'multipart/form-data') {
            const data = _.get(payload, 'data', {});
            const formData = new FormData();
            _.forEach(data, (value, key) => {
                formData.append(key, value || '');
            });
            formData.delete('id');
            _.set(payload, 'data', formData);
        }
        console.log(payload);
        const result = await this.makeApiRequest(url, method, payload);
        return result;
    },
};

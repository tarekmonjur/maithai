export default {
    asset (path) {
        const asset_path = window.assetURL || '';
        return asset_path + path;
    },
    isActive (value) {
        return value ? 'Active' : 'Inactive';
    },
    created (values) {
        // return `${values.created_at} <br> ${values.created_by}`;
    },
    updated (values) {
        return `${values.updated_at} <br> ${values.updated_by}`;
    },
    async setLang(force = false) {
        if (force || window.localStorage.getItem('lang') === null) {
            const result = await this.makeApiRequest(`/lang`, 'GET',{force});
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
            });
            data = result.data;
            // return data;
        } catch (err) {
            console.log(err.message);
        }
        return data;
    }
};

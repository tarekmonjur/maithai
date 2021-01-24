import helpers from "../js/helpers";
import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';

export default {
    state: {
        url: '/settings',
        lang_key: 'settings',
        ...state,
    },
    getters: {
        ...getters,
        settingsData: (state) => {
            return _.get(state, 'listData', []);
        }
    },
    actions: {
        ...actions,
    },
    mutations: {
        ...mutations,
    }
}

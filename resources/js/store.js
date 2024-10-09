export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket: {
            items: []
        }
    },
    mutations: {
        setLastSearch( state, payload ) {
            state.lastSearch = payload;
        },
        addToBasket(state , payload){
            state.basket.items.push(payload);
        }
    },
    actions:{

        setLastSearch(context, payload) {
            context.commit('setLastSearch',payload);
             localStorage.setItem('lastSearch',JSON.stringify(payload));
        },

        loadStorage(context){
            const lastSearch = localStorage.getItem('lastSearch');
            if (lastSearch){
                context.commit('setLastSearch',JSON.parse(lastSearch))
            }

        }
    }
};

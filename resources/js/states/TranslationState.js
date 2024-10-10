import { defineStore } from 'pinia';

export const useTranslationsState = defineStore('translationsState', {
    state: () => ({
        translationsState: {},
    }),
    actions: {
        setTranslations(t) {
            this.translationsState = t;
        },
    },
});
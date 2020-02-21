<template>
    <v-autocomplete
        v-model="model"
        :items="items"
        :loading="isLoading"
        :search-input.sync="search"
        clearable
        color="grey lighten-1"
        flat
        solo-inverted
        hide-details
        hide-selected
        prepend-inner-icon="mdi-magnify"
        :label="__('Pesquisar')"
        class="d-none d-sm-block"
    >
        <template v-slot:no-data>
            <v-list-item>
                <v-list-item-title>
                    Nenhum registro encontrado
                </v-list-item-title>
            </v-list-item>
        </template>
        <template v-slot:item="{ item }">
            <v-list-item-avatar
                color="indigo"
                class="headline font-weight-light white--text"
            >
                {{ item.name.charAt(0) }}
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title v-text="item.name"></v-list-item-title>
                <v-list-item-subtitle v-text="item.symbol"></v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action>
                <v-icon>mdi-coin</v-icon>
            </v-list-item-action>
        </template>
    </v-autocomplete>
</template>
<script>
export default {
    data: () => ({
        isLoading: false,
        items: [],
        model: null,
        search: null,
        tab: null,
    }),

    watch: {
        model (val) {
            if (val != null) this.tab = 0
            else this.tab = null
        },
        search (val) {
            // Items have already been loaded
            if (this.items.length > 0) return

            this.isLoading = true

            // Lazily load input items
            fetch('https://api.coinmarketcap.com/v2/listings/')
            .then(res => res.json())
            .then(res => {
                this.items = res.data
            })
            .catch(err => {
                console.log(err)
            })
            .finally(() => (this.isLoading = false))
        },
    },
}
</script>

<v-menu offset-y>
    <template v-slot:activator="{ on }">
        <v-btn icon v-on="on">
            <v-badge content="3" overlap>
                <v-icon>mdi-bell</v-icon>
            </v-badge>
        </v-btn>
    </template>

    <v-list>
        <template v-for="(item, index) in 3">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon color="grey lighten-1">mdi-note</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Título fdshkfjs</v-list-item-title>
                    <v-list-item-subtitle>Subtítulo fsd fdsaj</v-list-item-subtitle>
                </v-list-item-content>
                <v-list-item-action class="caption">
                    15 min
                </v-list-item-action>
            </v-list-item>

            <v-divider
                v-if="index + 1 < 3"
                :key="index"
            ></v-divider>
        </template>
    </v-list>
</v-menu>

<template>
  <div>
    <h1 class="headline mb-5">Criar notícia</h1>
    <v-card class="mb-5">
      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Imagem
        </v-col>
        <v-col cols="6">
          <v-file-input hide-details show-size outlined placeholder="Selecione uma imagem" prepend-icon="" append-icon="mdi-image"></v-file-input>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Items
        </v-col>
        <v-col cols="6">
          <v-select  hide-details outlined :items="['foo', 'bar']">
          </v-select>
        </v-col>
      </v-row>
      <v-divider></v-divider>
       <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Título
        </v-col>
        <v-col cols="6">
          <v-radio-group row>
            <v-radio label="Option 1" value="radio-1"></v-radio>
            <v-radio label="Option 2" value="radio-2"></v-radio>
          </v-radio-group>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Título
        </v-col>
        <v-col cols="6">
          <v-checkbox></v-checkbox>
        </v-col>
      </v-row>
      <v-divider></v-divider>

      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Título
        </v-col>
        <v-col cols="6">
          <v-text-field hide-details outlined></v-text-field>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Título
        </v-col>
        <v-col cols="6">
          <v-autocomplete
            :items="['foo', 'bar']"
            hide-details
            outlined
            chips
            small-chips
            multiple
          ></v-autocomplete>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-row class="pa-5">
        <v-col cols="3" align-self="center" class="text-right">
          Subtitulo
        </v-col>
        <v-col cols="6">
          <v-textarea outlined hide-details></v-textarea>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-card-actions class="grey lighten-5">
        <v-row>
          <v-col offset="3" cols="6">
             <v-btn :to="{name: 'resource', params: { resourceName }}" color="success" large>
              Criar notícia
            </v-btn>
          </v-col>
      </v-row>
      </v-card-actions>
    </v-card>
    <v-btn :to="{name: 'resource', params: { resourceName }}" dark>
          Voltar
        </v-btn>
  </div>
</template>
<script>
export default {
  props: ['resourceName']
}
</script>

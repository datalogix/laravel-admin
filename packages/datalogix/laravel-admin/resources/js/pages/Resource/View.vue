<template>
  <div>
    <h1 class="headline mb-5">Visualizar notícia</h1>
    <v-btn :to="{name: 'resource', params: { resourceName }}" dark>Voltar</v-btn>
  </div>
</template>
<script>
export default {
  props: ['resourceName'],
}
</script>

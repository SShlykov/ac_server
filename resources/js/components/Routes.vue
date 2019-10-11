<script>
  import DataBlock from "./common/DataBlock/DataBlock.vue";
  import RouteCard from "./custom/RouteCard.vue";

  export default {

    components: {
      RouteCard,
      DataBlock
    }
  }
</script>

<template>
    <DataBlock title="Маршруты" path="routes">
        <template slot-scope="{item}">
            <RouteCard v-bind:item="item" />
        </template>
    </DataBlock>
</template>

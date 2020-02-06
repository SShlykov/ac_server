<script>
import DataBlock from "./common/DataBlock/DataBlock.vue";
import RouteCard from "./custom/RouteCard.vue";

export default {
  components: {
    RouteCard,
    DataBlock
  }
};
</script>

<template>
  <DataBlock title="Маршруты" path="routes">
    <template slot-scope="{item, destroyItem, fetchData}">
      <RouteCard v-bind:fetchData="fetchData" v-bind:item="item" v-bind:destroyItem="destroyItem" />
    </template>
  </DataBlock>
</template>

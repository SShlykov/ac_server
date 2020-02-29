<script>
import DataBlock from "./common/DataBlock/DataBlock.vue";
import DriverCard from "./custom/DriverCard.vue";

export default {
  components: {
    DriverCard,
    DataBlock
  }
};
</script>

<template>
  <DataBlock title="Водители" path="drivers">
    <template slot-scope="{item, deleteItem, destroyItem}">
      <DriverCard
        v-bind:item="item"
        v-bind:deleteItem="deleteItem"
        v-bind:destroyItem="destroyItem"
      />
    </template>
  </DataBlock>
</template>

<script>
import DataBlock from "./common/DataBlock/DeletedItemsBlock.vue";
import DriverCard from "./custom/DeletedDriverCard.vue";

export default {
  components: {
    DriverCard,
    DataBlock
  }
};
</script>

<template>
  <DataBlock title="Водители" path="drivers">
    <template slot-scope="{item, restoreItem, destroyItem}">
      <DriverCard
        v-bind:item="item"
        v-bind:destroyItem="destroyItem"
        v-bind:restoreItem="restoreItem"
      />
    </template>
  </DataBlock>
</template>

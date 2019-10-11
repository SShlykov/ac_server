<script>
    import DataBlock from "./common/DataBlock/DataBlock.vue";
    import DriverCard from "./custom/DriverCard.vue";

    export default {

      components: {
        DriverCard,
        DataBlock
      }
  }
</script>

<template>
    <DataBlock title="Водители" path="drivers">
        <template slot-scope="{item, deleteItem}">
            <DriverCard v-bind:item="item" v-bind:deleteItem="deleteItem" />
        </template>
    </DataBlock>
</template>

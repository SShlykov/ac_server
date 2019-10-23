<script>
import DataBlock from "./common/DataBlock/DataBlock.vue";
import Test from "./custom/Test.vue";

export default {
  name: "Tests",
  components: {
    Test,
    DataBlock
  },
  data() {
    return {
      color: "blue"
    };
  },
  methods: {
    getKeys() {
      return "bestKey";
    },
    handleClick() {
      if (this.color == "blue") this.color = "red";
      else this.color = "blue";
    }
  }
};
</script>

<template>
  <test :color="color" :changeColor="handleClick"></test>
</template>

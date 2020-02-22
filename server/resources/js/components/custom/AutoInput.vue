<template>
  <div>
    <input
      class="main_input"
      type="text"
      v-model="inputText"
      @focus="magic_flag = true"
      v-on:keyup="filterText"
    />
    <button v-if="magic_flag" class="main_input_close" @click.prevent="closeDropList">X</button>
    <div class="main_input_container" v-if="magic_flag">
      <div
        v-for="item in showItems"
        v-bind:key="random(item)"
        class="main_input_dropitems"
        @click.prevent="writeToInput(item)"
      >{{ item }}</div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AutoInput",
  props: {
    items: {
      require: true
    },
    returnData: {
      require: true
    },
    inputText: {
      require: false
    }
  },
  data() {
    return {
      showItems: [],
      countShow: 5,
      textInput: "",
      magic_flag: false
    };
  },
  async created() {
    this.updateShowItems();
  },
  methods: {
    updateShowItems() {
      this.showItems = [];
      for (let i = 0; i < this.countShow; i++) {
        if (this.items[i]) this.showItems.push(this.items[i]);
      }
    },
    writeToInput(item) {
      this.inputText = item;
      this.closeDropList();
      this.returnData(item);
    },
    filterText() {
      if (this.inputText == "") this.updateShowItems();
      else {
        this.showItems = [];
        let count = 0;
        for (let i = 0; i < this.items.length; i++) {
          if (count == this.countShow) {
            break;
          }
          if (
            this.items[i].toUpperCase().indexOf(this.inputText.toUpperCase()) !=
            -1
          ) {
            this.showItems.push(this.items[i]);
            count++;
          }
        }
      }
    },
    random(item) {
      return Math.random();
    },
    closeDropList() {
      this.magic_flag = false;
    }
  }
};
</script>

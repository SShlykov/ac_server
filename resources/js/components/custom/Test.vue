<template>
  <div>
    <div :class="'block '+ color" @click="changeColor"></div>
    <button @click="changeText">{{outputDiv}}</button>
  </div>
</template>

<script>
export default {
  name: "Test",
  props: {
    color: {
      required: true,
      type: String
    },
    changeColor: {
      required: false
    }
  },
  data() {
    return {
      outputDiv: "Hellow my friend!"
    };
  },
  methods: {
    changeText() {
      this.outputDiv = "my little code";
    }
  },
  components: {}
};
</script>
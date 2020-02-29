<template>
  <div>
    this is side bar
  </div>
</template>

<script>
export default {
  name: "SideBar",
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
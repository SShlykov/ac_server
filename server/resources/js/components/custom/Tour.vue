<template>
  <a href="/home/category/1" class="tour_card">
    <div class="tour_card_info">
      <div class="tour_card_icon">
        <figure>
          <img src="../../../../public/images/icon-fire.svg" alt="delete" />
        </figure>
      </div>
      <div class="tour_card_title" v-if="!edit">{{tour_name}}</div>
      <input type="text" class="main_input ml-4" v-if="edit" v-model="tour_name" />
    </div>
    <div class="tour_card_functions">
      <div class="tour_functions_delete d-flex">
        <figure class="mb-0" @click.prevent="toggleEdit">
          <img src="../../../../public/images/pen.svg" alt="edit" v-if="!edit" />
          <img src="../../../../public/images/close.svg" alt="close" v-if="edit" />
        </figure>
        <figure class="mb-0 ml-3">
          <img src="../../../../public/images/save.svg" alt="edit" v-if="edit" />
        </figure>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  name: "Tour",
  props: {
    tour_disabled_up: {
      required: false
    },
    tour_disabled_down: {
      required: false
    },
    name: {
      required: true
    },
    id: {
      required: true
    }
  },
  data() {
    return {
      outputDiv: "Hellow my friend!",
      edit: false,
      tour_name: ""
    };
  },
  async created() {
    this.tour_name = this.name;
  },
  methods: {
    changeText() {
      this.outputDiv = "my little code";
    },
    toggleEdit() {
      this.edit = !this.edit;
    }
  },
  components: {}
};

// <a :class="'tour_functions_down ' + tour_disabled_down" href="#">
//   <figure>
//     <img src="../../../../public/images/arrow_down.svg" alt="down" />
//   </figure>
// </a>
// <a :class="'tour_functions_up ' + tour_disabled_up" href="#">
//   <figure>
//     <img src="../../../../public/images/arrow_up.svg" alt="up" />
//   </figure>
// </a>
</script>
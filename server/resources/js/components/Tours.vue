<template>
  <div class="page_container">
    <h2 class="tour_title">Управление турами</h2>
    <tour v-for="item in categories" :id="item.id" :name="item.name" v-bind:key="random(item)"></tour>
  </div>
</template>



<script>
import Tour from "./custom/Tour.vue";
import AddTour from "./custom/AddTour.vue";

export default {
  name: "Tours",
  components: {
    Tour,
    AddTour
  },
  data() {
    return {
      categories: {}
    };
  },
  async created() {
    this.getCategories();
    console.log(this.categories);
  },
  methods: {
    async getCategories() {
      await fetch(`/api/category`)
        .then(res => res.json())
        .then(res => (this.categories = res.data))
        .catch(err => console.log(err));
    },
    random(item) {
      return Math.random();
    }
  }
};

//<tour :tour_disabled_up="'tour_disabled'"></tour>
//<tour :tour_disabled_down="'tour_disabled'"></tour>
</script>

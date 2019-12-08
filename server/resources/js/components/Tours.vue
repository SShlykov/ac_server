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
    return {};
  },
  methods: {}
};
</script>

<template>
  <div class="page_container">
    <h2 class="tour_title">Управление турами</h2>
    <tour :tour_disabled_up="'tour_disabled'"></tour>
    <tour></tour>
    <tour></tour>
    <tour :tour_disabled_down="'tour_disabled'"></tour>
    <AddTour></AddTour>
  </div>
</template>

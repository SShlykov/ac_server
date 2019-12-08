<script>
import TourCard from "../custom/TourCard.vue";
import AddTour from "./../custom/AddTour.vue";

export default {
  name: "Сategory",
  props: {},
  data() {
    return {};
  },
  methods: {},
  components: {
    TourCard,
    AddTour
  }
};
</script>



<template>
  <div class="page_container">
    <div class="category_title">
      <img src="../../../../public/images/icon-fire.svg" alt />
      <h2 class="tour_title">Популярное</h2>
    </div>
    <TourCard></TourCard>
    <TourCard></TourCard>
    <AddTour></AddTour>
  </div>
</template>

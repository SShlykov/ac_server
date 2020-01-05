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


<script>
import TourCard from "../custom/TourCard.vue";
import AddTour from "./../custom/AddTour.vue";

export default {
  name: "category",
  props: ["id"],
  data() {
    return {
      page_id: ""
    };
  },
  methods: {},
  async created() {
    this.page_id = document.location.href[document.location.href.length - 1];
    console.log(this.id);
  },
  components: {
    TourCard,
    AddTour
  }
};
</script>

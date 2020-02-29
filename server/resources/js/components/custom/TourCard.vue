<template>
  <div class="tour_card category_card"></div>
</template>

<script>
import Image from "../common/Image.vue";

export default {
  name: "TourCard",
  props: {
    item: {
      required: false
    }
  }
};
</script>
 
<template>
  <a href="/home/category/1" class="tour_card">
    <div class="tour_card_info">
      <div class="tour_card_icon">
        <figure>
          <img src="../../../../public/images/icon-fire.svg" alt="delete" />
        </figure>
      </div>
      <div class="tour_card_title">Популярное</div>
    </div>
    <div class="tour_card_functions">
      <a class="tour_functions_delete" href="#">
        <figure>
          <img src="../../../../public/images/trash.svg" alt="delete" />
        </figure>
      </a>
      <a :class="'tour_functions_down ' + tour_disabled_down" href="#">
        <figure>
          <img src="../../../../public/images/arrow_down.svg" alt="delete" />
        </figure>
      </a>
      <a :class="'tour_functions_up ' + tour_disabled_up" href="#">
        <figure>
          <img src="../../../../public/images/arrow_up.svg" alt="delete" />
        </figure>
      </a>
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
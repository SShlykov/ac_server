<template>
  <div class="review">
    <div class="d-flex review_data">
      <div>
        <div class="d-flex review_data_info">
          <div class="review_data_info-name">{{name}}</div>
          <div class="ml-3 review_data_info-date">{{date}}</div>
        </div>
        <div class="review_data_stars">
          <div v-bind:key="random(item)" v-for="item in stars">
            <img src="../../../../public/images/StarGreen.svg" alt="GreenStars" />
          </div>
          <div v-bind:key="random(item)" v-for="item in 5-stars">
            <img src="../../../../public/images/StarGray.svg" alt="GrayStars" />
          </div>
        </div>
      </div>
    </div>
    <textarea addAutoResize v-model="description" class="mt-4" name rows="13"></textarea>
    <div class="category_card_functions">
      <div class="category_card_functions-circle">
        <figure>
          <img src="../../../../public/images/save.svg" alt />
        </figure>
      </div>
      <div class="category_card_functions-circle">
        <figure>
          <img src="../../../../public/images/trash.svg" alt />
        </figure>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Review",
  props: {
    name: {
      required: true,
      type: String
    },
    date: {
      required: true,
      type: String
    },
    stars: {
      required: true
    },
    description: {
      required: true
    },
    id: {
      required: true
    }
  },
  data() {
    return {};
  },
  async created() {
    console.log(this.id);
  },
  methods: {
    review_delete() {},
    review_update() {},
    random(item) {
      return Math.random();
    }
  },
  components: {}
};

function addAutoResize() {
  document.querySelectorAll("[data-autoresize]").forEach(function(element) {
    element.style.boxSizing = "border-box";
    var offset = element.offsetHeight - element.clientHeight;
    document.addEventListener("input", function(event) {
      event.target.style.height = "auto";
      event.target.style.height = event.target.scrollHeight + offset + "px";
    });
    element.removeAttribute("data-autoresize");
  });
}
</script>

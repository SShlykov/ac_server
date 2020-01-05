<template>
  <div class="w-100 d-flex justify-content-center">
    <button class="button_add_item" @click.prevent="add_item">+</button>
  </div>
</template>



<script>
export default {
  name: "AddTour",
  props: {
    driver_id: {
      required: false
    },
    tourName: {
      required: false
    },
    updateItem: {
      required: false
    }
  },
  data() {
    return {
      review: {
        driver_id: "",
        author: "",
        text: "",
        rating: ""
      }
    };
  },
  async created() {
    await this.startDriver();
    this.startTour();
  },
  methods: {
    async startDriver() {
      if (this.driver_id) {
        this.review.driver_id = this.driver_id;
        this.review.author = "some name";
        (this.review.rating = "1"), (this.review.text = "text");
      }
    },
    async startTour() {
      if (this.tourName) console.log("Add tour created");
    },
    async add_item() {
      let review = this.review;
      if (this.driver_id) {
        console.log(this.review);
        await fetch(`/api/review/`, {
          method: "post",
          body: JSON.stringify(review),
          headers: {
            "Content-Type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            alert(`${this.driver.name} удален`);
          })
          .catch(err => console.log(err));
        this.updateItem();
      }
      if (this.tourName) {
      }
    }
  }
};
</script>
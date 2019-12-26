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
    if (this.driver_id) {
      this.review.driver_id = this.driver_id;
      this.review.author = "some name";
      (this.review.rating = "1"), (this.review.text = "text");
    }
  },
  methods: {
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
            window.location.href = "/home/driver/" + this.driver_id;
          })
          .catch(err => console.log(err));
      }
      window.location.href = "/home/driver/" + this.driver_id;
    }
  }
};
</script>
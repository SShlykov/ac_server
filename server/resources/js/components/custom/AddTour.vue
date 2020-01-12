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
      },
      tour: {
        name: "",
        image:
          "https://sun9-38.userapi.com/c854320/v854320805/1b8e14/afhOhLK6rkU.jpg",
        time: "Час пути",
        text: "Описание"
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
        this.review.author = "Имя автора";
        (this.review.rating = "1"), (this.review.text = "Текст отзыва");
      }
    },
    async startTour() {
      if (this.tourName) {
        this.tour.name =
          "Тур " +
          Math.random()
            .toString(36)
            .replace(/[^a-z]+/g, "");
      }
    },
    async add_item() {
      if (this.driver_id) {
        let review = this.review;
        await fetch(`/api/review/`, {
          method: "post",
          body: JSON.stringify(review),
          headers: {
            "Content-Type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {})
          .catch(err => console.log(err));
        this.updateItem();
      }
      if (this.tourName) {
        await fetch(`/api/tour/`, {
          method: "post",
          body: JSON.stringify(this.tour),
          headers: {
            "Content-Type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {})
          .catch(err => console.log(err));
        this.updateItem();
        this.startTour();
      }
    }
  }
};
</script>
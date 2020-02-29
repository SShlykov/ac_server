<template>
  <div class="mb-5 w-100 d-flex justify-content-center" v-if="work">
    <div class="review" v-if="!editMode">
      <div class="d-flex review_data">
        <div>
          <div class="d-flex review_data_info">
            <div class="review_data_info-name">{{ item.author }}</div>
            <div class="ml-3 review_data_info-date">{{ date }}</div>
          </div>
          <div class="review_data_stars">
            <div v-bind:key="random(item)" v-for="item in stars">
              <img src="../../../../public/images/StarGreen.svg" alt="GreenStars" />
            </div>
            <div v-bind:key="random(item)" v-for="item in 5 - stars">
              <img src="../../../../public/images/StarGray.svg" alt="GrayStars" />
            </div>
          </div>
        </div>
      </div>
      <textarea-autosize
        readonly
        placeholder="Текст отзыва"
        ref="myTextarea"
        v-model="item.text"
        :min-height="30"
        :max-height="350"
      />
      <div class="category_card_functions">
        <div class="category_card_functions-circle" @click.prevent="toggleEdit">
          <figure>
            <img src="../../../../public/images/pen.svg" alt />
          </figure>
        </div>
        <div class="category_card_functions-circle" @click.prevent="delete_review">
          <figure>
            <img src="../../../../public/images/trash.svg" alt />
          </figure>
        </div>
      </div>
    </div>
    <div class="review" v-if="editMode">
      <div class="d-flex review_data">
        <div>
          <div class="d-flex review_data_info d-flex align-items-center mb-2">
            <input type="text" class="review_data_info-name main_input" v-model="item.author" />
            <div class="ml-3 review_data_info-date">{{ date }}</div>
          </div>
          <div class="review_data_stars d-flex align-items-center">
            <span>Рейтинг:</span>
            <input class="ml-3 main_input main_input_40 main_input_center" v-model="item.rating" />
          </div>
        </div>
      </div>
      <textarea-autosize
        placeholder="Текст отзыва"
        ref="myTextarea"
        v-model="item.text"
        :min-height="30"
        :max-height="350"
      />
      <div class="category_card_functions">
        <div class="category_card_functions-circle" @click.prevent="update_review">
          <figure>
            <img src="../../../../public/images/save.svg" alt />
          </figure>
        </div>
        <div class="category_card_functions-circle" @click.prevent="toggleEdit">
          <figure>
            <img src="../../../../public/images/close.svg" alt />
          </figure>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import TextareaAutosize from "vue-textarea-autosize";
Vue.use(TextareaAutosize);

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
    },
    driver_id: {
      required: true
    },
    updateItem: {
      required: true
    }
  },
  data() {
    return {
      work: true,
      item: {
        id: "",
        author: "",
        text: "",
        rating: "",
        driver_id: ""
      },
      editMode: false
    };
  },
  async created() {
    await this.getReview();
  },
  methods: {
    async getReview() {
      this.item.id = this.id;
      this.item.author = this.name;
      this.item.text = this.description;
      this.item.rating = this.stars;
      this.item.driver_id = this.driver_id;
    },
    async update_review() {
      if (this.item.rating < 1 || this.item.rating > 5) {
        alert("Рейтинг должен быть в пределах от 1 до 5");
      }
      if (
        confirm("Обновить?") &&
        this.item.rating > 0 &&
        this.item.rating < 6
      ) {
        await fetch(`/api/review/`, {
          method: "put",
          body: JSON.stringify(this.item),
          headers: {
            "Content-Type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            alert(`Отзыв был обновлен`);
          })
          .catch(err => console.log(err));
      }
      this.toggleEdit();
      this.updateItem();
    },
    async delete_review() {
      if (confirm("Вы точно хотите удалить отзыв?")) {
        await fetch(`/api/review/${this.id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`Отзыв удален`);
            this.work = false;
          })
          .catch(err => console.log(err));
      }
    },
    random(item) {
      return Math.floor(Math.random() * Math.pow(10, 20)) + Math.random();
    },
    toggleEdit() {
      this.editMode = !this.editMode;
    },
    z() {}
  },
  components: {}
};
</script>

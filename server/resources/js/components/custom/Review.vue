<template>
    <div class="review">
        <div class="d-flex review_data">
            <div>
                <div class="d-flex review_data_info">
                    <div class="review_data_info-name">{{ name }}</div>
                    <div class="ml-3 review_data_info-date">{{ date }}</div>
                </div>
                <div class="review_data_stars">
                    <div v-bind:key="random(item)" v-for="item in stars">
                        <img
                            src="../../../../public/images/StarGreen.svg"
                            alt="GreenStars"
                        />
                    </div>
                    <div v-bind:key="random(item)" v-for="item in 5 - stars">
                        <img
                            src="../../../../public/images/StarGray.svg"
                            alt="GrayStars"
                        />
                    </div>
                </div>
            </div>
        </div>
        <textarea-autosize
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="description"
            :min-height="30"
            :max-height="350"
            @blur.native="onBlurTextarea"
        />
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
        review_update() {
      await fetch(`/api/driver/`, {
        method: "put",
        body: JSON.stringify(driver),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`${this.driver.name} обновлен`);
          window.location.href = "/home/driver/" + driver.id;
        })
        .catch(err => console.log(err));
        },
        random(item) {
            return Math.random();
        }
    },
    components: {}
};
</script>

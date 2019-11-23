<template>
  <div class="w-100 driver-container">
    <div
      v-if="!this.loading.data"
      class="card justify-content-center align-items-center p-3 d-flex w-100 h-100"
    >
      <Spinner />
    </div>
    <div class="driver-page card p-3" v-if="this.loading.data">
      <Goback></Goback>
      <div class="w-100 card d-flex justify-content-center flex-wrap flex-row">
        <div class="w49 hfull p-3">
          <figure class>
            <img :src="this.driver.photo" class="w-100" />
          </figure>
        </div>
        <div class="w49 p-4 data-block" v-if="!editMode">
          <h2>Водитель</h2>
          <span class="id-top">id водителя: {{this.driver.id}}</span>
          <h3>
            <span>Имя водителя:</span>
            {{this.driver.name}}
          </h3>
          <h3>
            <span>Фамилия водителя:</span>
            {{this.driver.last_name}}
          </h3>
          <h3>
            <span>Телефон водителя:</span>
            +{{this.driver.phone}}
          </h3>
          <button @click.prevent="deleteDriver" class="btn btn-danger">Удалить</button>
          <button
            @click.prevent="toggleEditMode"
            class="btn btn-outline-primary ml-2"
          >Редактировать водителя</button>
        </div>
        <div class="w49 p-4 data-block" v-if="editMode">
          <h2>Водитель</h2>
          <span class="id-top">id водителя: {{this.driver.id}}</span>
          <h3>
            <span>Имя водителя:</span>
            <input type="text" v-model="driver.name" />
          </h3>
          <h3>
            <span>Фамилия водителя::</span>
            <input type="text" v-model="driver.last_name" />
          </h3>
          <h3>
            <span>Телефон водителя:</span>
            <input type="text" v-model="driver.phone" />
          </h3>
          <h3>
            <span>Картинка водителя:</span>
            <input type="file" @change="onImageSelected" />
          </h3>
          <h3>
            <span>Машина перед:</span>
            <input type="file" @change="No" />
          </h3>
          <h3>
            <span>Машина сбоку:</span>
            <input type="file" @change="No" />
          </h3>
          <h3>
            <span>Машина сзади:</span>
            <input type="file" @change="No" />
          </h3>
          <button @click.prevent="updateDriver" class="btn btn-outline-primary">Сохранить</button>
          <button
            @click.prevent="toggleEditMode"
            class="btn btn-outline-secondary"
          >Выйти из режима редактирования</button>
        </div>
        <div class="data-block" v-if="!editRouts">
          <button class="btn btn-primary" @click.prevent="toggleEditRouts">Изменить маршруты</button>
        </div>
        <div class="d-flex justify-content-center flex-wrap w-100" v-if="editRouts">
          <div class="routs_item_width">
            <input type="text" />
            <button class="btn btn-outline-primary ml-2">Добавить группу</button>
          </div>
          <RouteItem :name="'Новосибирск-Барнаул'"></RouteItem>
          <RouteItem :name="'Барнаул-Ая'"></RouteItem>
          <RouteItem :name="'Ая-Белуха'"></RouteItem>
          <RouteItem :name="'Брянск-Девяткино'"></RouteItem>
          <div class="w-100 d-flex justify-content-center">
            <button class="btn btn-primary mt-4" @click.prevent="toggleEditRouts">Выйти</button>
          </div>
        </div>
        <section class="d-flex align-items-center flex-column reviews">
          <h3 class="mb-4">Отзывы</h3>
          <Review
            v-bind:key="item"
            v-for="item in reviews"
            :photo="photo"
            :name="item.author"
            :date="item.updated_at"
            :stars="item.rating"
            :description="item.text"
          ></Review>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from "../common/spinner";
import CarBlock from "../custom/CarBlock";
import LoadingSpinner from "../common/LoadingSpinner/LoadingSpinner";
import Goback from "../common/goback";
import Review from "../custom/Review";
import RouteItem from "../custom/RouteItem";
export default {
  name: "Driver",
  components: { Goback, LoadingSpinner, CarBlock, Spinner, Review, RouteItem },
  props: ["id"],

  data() {
    return {
      reviews: [],
      loading: {
        data: false
      },
      photo:
        "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80",
      driver: {
        id: "",
        name: "",
        last_name: "",
        photo: "",
        phone: ""
      },
      editMode: false,
      editRouts: false,
      imageSelected: null
    };
  },
  async created() {
    await this.getDriver();
    await this.getReview();
    this.loading.data = true;
  },
  methods: {
    async getReview() {
      await fetch(`/api/review/driver/${this.id}`)
        .then(res => res.json())
        .then(res => (this.reviews = res.data))
        .catch(err => console.log(err));
    },
    async getDriver() {
      await fetch(`/api/driver/${this.id}`)
        .then(res => res.json())
        .then(res => (this.driver = res.data))
        .catch(err => console.log(err));
    },
    async deleteDriver() {
      if (confirm("Вы точно хотите удалить?")) {
        await fetch(`/api/driver/${this.driver.id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`${this.driver.name} удален`);
            window.location.href = "/home/drivers";
          })
          .catch(err => console.log(err));
      }
    },
    async updateDriver() {
      let driver = this.driver;
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
          window.location.href = "/home/drivers";
        })
        .catch(err => console.log(err));
    },
    toggleEditMode() {
      this.editMode = !this.editMode;
    },
    toggleEditRouts() {
      this.editRouts = !this.editRouts;
    },
    onImageSelected(e) {
      this.imageSelected = e.target.files[0];
    }
  }
};
</script>

<style scoped>
</style>

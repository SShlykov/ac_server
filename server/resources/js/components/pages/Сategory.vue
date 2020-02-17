<template>
  <div class="page_container">
    <a href="/home/tours">Назад</a>
    <div class="category_title">
      <img src="../../../../public/images/bus.svg" alt />
      <h2 class="tour_title">Название: {{tour.name}}</h2>
    </div>
    <section class="mb-3 d-flex align-items-start">
      <figure class="tourPage_figure">
        <img :src="tour.image" class="img-thumbnail rounded mx-auto d-block" alt="foto of tour" />
      </figure>
      <div class="d-flex flex-column ml-4">
        <input class="mt-3 mb-3" type="file" @change="imageTourChange" />
        <button
          v-if="!tourImageChanged"
          @click.prevent="chooseImage"
          class="btn btn-outline-primary w-50 disabled"
        >Сохранить</button>
        <button
          @click.prevent="uploadImage"
          v-if="tourImageChanged"
          class="btn btn-outline-primary w-50"
        >Сохранить</button>
      </div>
    </section>
    <section class="car_data">
      <h4>Данные:</h4>
      <div class="car_data_noedit" v-if="!this.editTour">
        <div class="car_data_item">
          <span class="data">ID:</span>
          <span class="text">{{tour.id}}</span>
        </div>
        <div class="car_data_item">
          <span class="data">Название:</span>
          <span class="text">{{tour.name}}</span>
        </div>
        <div class="car_data_item">
          <span class="data">Длительность:</span>
          <span class="text">{{tour.time}}</span>
        </div>
        <button
          type="button"
          class="btn btn-outline-primary"
          @click.prevent="toggleEditTour"
        >Редактировать</button>
        <button type="button" class="btn btn-outline-dark ml-3">Удалить тур</button>
      </div>
      <div class="car_data_noedit" v-if="this.editTour">
        <div class="car_data_item">
          <span class="data">ID:</span>
          <span class="text">{{tour.id}}</span>
        </div>
        <div class="car_data_item">
          <span class="data">Название:</span>
          <input class="main_input" type="text" v-model="tour.name" />
        </div>
        <div class="car_data_item">
          <span class="data">Длительность:</span>
          <input class="main_input" type="text" v-model="tour.time" />
        </div>
        <button
          type="button"
          class="btn btn-outline-primary btn_edit"
          @click.prevent="updateTour"
        >Сохранить</button>
        <button
          type="button"
          class="btn btn-outline-dark btn_edit"
          @click.prevent="toggleEditTour"
        >Отмена</button>
      </div>
    </section>
    <section class="mb-5 tour-description w-100 d-flex flex-column">
      <h4>Описание тура:</h4>
      <textarea-autosize
        readonly
        class="tour-description_noedit"
        v-if="!editText"
        placeholder="Описание тура"
        ref="myTextarea"
        v-model="tour.text"
        :min-height="30"
        :max-height="350"
      />
      <textarea-autosize
        class="tour-description_edit"
        v-if="editText"
        placeholder="Текст отзыва"
        ref="myTextarea"
        v-model="tour.text"
        :min-height="30"
        :max-height="350"
      />
      <div v-if="!editText" class="mt-2 d-flex">
        <button class="btn btn-outline-primary" @click.prevent="toggleEditText()">Изменить описание</button>
      </div>
      <div v-if="editText" class="mt-1 d-flex">
        <button class="btn btn-outline-primary" @click.prevent="updateTour">Сохранить</button>
        <button class="btn btn-outline-secondary ml-2" @click.prevent="toggleEditText()">Отменить</button>
      </div>
    </section>
    <div class="d-flex w-100 mb-5" v-if="!editCategories">
      <button class="btn btn-primary" @click.prevent="toggleEditCategories">Изменить категории</button>
    </div>
    <div class="d-flex justify-content-center flex-wrap w-100" v-if="editCategories">
      <div class="routs_item_width">
        <AutoInput :items="namesCaterory" :returnData="getNameCategory"></AutoInput>
        <button
          class="btn btn-outline-primary ml-2"
          @click.prevent="connectCategoryToTour"
        >Добавить группу</button>
      </div>
      <RouteItem
        v-bind:key="random(item)"
        v-for="item in connectedCategoryes"
        :name="item.name"
        :id="id"
        :route_id="item.id"
        :purpose="'tourcategory'"
        :getRouts="getConnectedCategoryes"
      ></RouteItem>
      <div class="w-100 d-flex justify-content-center">
        <button class="btn btn-primary mt-4" @click.prevent="toggleEditCategories">Выйти</button>
      </div>
    </div>
    <div class="d-flex w-100" v-if="!editRoutes">
      <button class="btn btn-primary" @click.prevent="toggleEditRouted">Изменить маршруты</button>
    </div>
    <div class="d-flex justify-content-center flex-wrap w-100" v-if="editRoutes">
      <div class="routs_item_width">
        <AutoInput :items="namesRoutes" :returnData="getNameRoute"></AutoInput>
        <button
          class="btn btn-outline-primary ml-2"
          @click.prevent="connectRouteToTour"
        >Добавить точку</button>
      </div>
      <RouteItem
        v-bind:key="random(item)"
        v-for="item in connectedRoutes"
        :name="item.name"
        :id="id"
        :route_id="item.id"
        :purpose="'tourroutes'"
        :getRouts="getConnectedRoutes"
      ></RouteItem>
      <div class="w-100 d-flex justify-content-center">
        <button class="btn btn-primary mt-4" @click.prevent="toggleEditRouted">Выйти</button>
      </div>
    </div>
  </div>
</template>


<script>
import Vue from "vue";
import TextareaAutosize from "vue-textarea-autosize";
Vue.use(TextareaAutosize);

import TourCard from "../custom/TourCard.vue";
import AddTour from "./../custom/AddTour.vue";
import AutoInput from "../custom/AutoInput";
import RouteItem from "../custom/RouteItem";

export default {
  name: "category",

  components: {
    TourCard,
    AddTour,
    AutoInput,
    RouteItem
  },
  props: ["id"],
  data() {
    return {
      tour: {
        id: "",
        name: "",
        image: "",
        time: "",
        text: ""
      },
      editTour: false,
      editCategories: false,
      editText: false,
      editRoutes: false,
      tourImageChanged: false,
      selectNameCategory: "",
      selectNameRoute: "",
      namesCaterory: [],
      connectedCategoryes: [],
      connectedRoutes: [],
      namesRoutes: []
    };
  },
  async created() {
    await this.getTour();
    await this.getCategorieNames();
    await this.getConnectedCategoryes();
    await this.getConnectedRoutes();
    await this.getRoutesNames();
  },
  methods: {
    async getTour() {
      await fetch(`/api/tour/` + this.id)
        .then(res => res.json())
        .then(res => (this.tour = res.data))
        .catch(err => console.log(err));
    },
    async getCategorieNames() {
      let categories;
      await fetch(`/api/category/all`)
        .then(res => res.json())
        .then(res => (categories = res.data))
        .catch(err => console.log(err));
      this.namesCaterory = categories.map(x => x.name);
    },
    async getRoutesNames() {
      let routes;
      await fetch(`/api/route/routes/all`)
        .then(res => res.json())
        .then(res => (routes = res.data))
        .catch(err => console.log(err));
      this.namesRoutes = routes.map(el => el.name);
    },
    async getConnectedRoutes() {
      await fetch(`/api/tour/show/routes/` + this.id)
        .then(res => res.json())
        .then(res => (this.connectedRoutes = res))
        .catch(err => console.log(err));
      console.log(this.connectedRoutes);
    },
    async getConnectedCategoryes() {
      await fetch(`/api/tour/category/` + this.id)
        .then(res => res.json())
        .then(res => (this.connectedCategoryes = res))
        .catch(err => console.log(err));
    },
    getNameCategory(item) {
      this.selectNameCategory = item;
    },
    getNameRoute(item) {
      this.selectNameRoute = item;
    },
    async connectCategoryToTour() {
      const dataRequest = {
        tour_id: this.id,
        category_name: this.selectNameCategory
      };
      await fetch(`/api/tour/connect/category`, {
        method: "post",
        body: JSON.stringify(dataRequest),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {})
        .catch(err => console.log(err));
      this.getConnectedCategoryes();
    },
    async connectRouteToTour() {
      const dataRequest = {
        tour_id: this.id,
        route_name: this.selectNameRoute
      };
      await fetch(`/api/tour/connect/route`, {
        method: "post",
        body: JSON.stringify(dataRequest),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {})
        .catch(err => console.log(err));
      this.getConnectedRoutes();
    },
    async uploadImage() {
      await fetch(`/api/tour/upload/photo`, {
        method: "put",
        body: JSON.stringify(this.tour),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert("Картинка обновлена");
        })
        .catch(err => console.log(err));
      this.getTour();
      if (this.editText) this.toggleEditText();
      if (this.editTour) this.toggleEditTour();
    },
    async updateTour() {
      await fetch(`/api/tour/`, {
        method: "put",
        body: JSON.stringify(this.tour),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {})
        .catch(err => console.log(err));
      this.getTour();
      if (this.editText) this.toggleEditText();
      if (this.editTour) this.toggleEditTour();
    },
    toggleEditTour() {
      this.editTour = !this.editTour;
    },
    toggleEditCategories() {
      this.editCategories = !this.editCategories;
    },
    toggleEditText() {
      this.editText = !this.editText;
    },
    toggleEditRouted() {
      this.editRoutes = !this.editRoutes;
    },
    imageTourChange(e) {
      let fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);

      fileReader.onload = e => {
        this.tour.image = e.target.result;
      };
      this.tourImageChanged = true;
    },
    chooseImage() {
      alert("Выберите картинку");
    },
    random(item) {
      return Math.random();
    }
  }
};
</script>

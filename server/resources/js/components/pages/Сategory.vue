<template>
  <div class="page_container">
    <div class="category_title">
      <img src="../../../../public/images/bus.svg" alt />
      <h2 class="tour_title">Название: {{tour.name}}</h2>
    </div>
    <section class="mb-3 d-flex align-items-start">
      <figure class="tourPage_figure">
        <img :src="tour.image" class="img-thumbnail rounded mx-auto d-block" alt="foto of tour" />
      </figure>
      <input class="mt-3 ml-4" type="file" @change="imageTourChange" />
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
        <div class="car_data_item">
          <span class="data">Описание:</span>
          <span class="text">{{tour.text}}</span>
        </div>
        <button
          type="button"
          class="btn btn-outline-dark"
          @click.prevent="toggleEditTour"
        >Редактировать</button>
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
    <div class="data-block" v-if="!editCategories">
      <button class="btn btn-primary" @click.prevent="toggleEditCategories">Изменить категории</button>
    </div>
    <div class="d-flex justify-content-center flex-wrap w-100" v-if="editCategories">
      <div class="routs_item_width">
        <AutoInput :items="nameRouteGroups" :returnData="postRouteName"></AutoInput>
        <button class="btn btn-outline-primary ml-2" @click.prevent="connectRG">Добавить группу</button>
      </div>
      <RouteItem
        v-bind:key="random(item)"
        v-for="item in routegroups"
        :name="item.name"
        :id="id"
        :route_id="item.id"
        :purpose="'driverrouts'"
        :getRouts="getRouteGroups"
      ></RouteItem>
      <div class="w-100 d-flex justify-content-center">
        <button class="btn btn-primary mt-4" @click.prevent="toggleEditCategories">Выйти</button>
      </div>
    </div>
  </div>
</template>


<script>
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
        time: ""
      },
      editTour: false,
      editCategories: false
    };
  },
  async created() {
    await this.getTour();
    console.log(this.tour);
  },
  methods: {
    async getTour() {
      console.log(this.id);
      await fetch(`/api/tour/` + this.id)
        .then(res => res.json())
        .then(res => (this.tour = res.data))
        .catch(err => console.log(err));
    },
    toggleEditTour() {
      this.editTour = !this.editTour;
    },
    toggleEditCategories() {
      this.editCategories = !editCategories;
    },
    updateTour() {},
    imageTourChange() {}
  }
};
</script>

<template>
  <div class="w-100 driver-container">
    <div
      v-if="!this.loading.data"
      class="card justify-content-center align-items-center p-3 d-flex w-100 h-100"
    >
      <Spinner />
    </div>
    <div class="driver-page card p-3" v-if="this.loading.data">
      <a href="/home/drivers">Назад</a>
      <div class="w-100 card d-flex justify-content-center flex-wrap flex-row">
        <div class="w49 hfull p-3">
          <figure class="driverpage-friver-photo">
            <img :src="this.driver.photo" class="w-100" />
          </figure>
        </div>
        <div class="w49 p-4 data-block mb30" v-if="!editMode">
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
        <div class="w49 p-4 data-block mb30" v-if="editMode">
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
            <input type="file" @change="imageDriverChanged" />
          </h3>
          <button @click.prevent="updateDriver" class="btn btn-outline-primary">Сохранить</button>
          <button
            @click.prevent="toggleEditMode"
            class="btn btn-outline-secondary"
          >Выйти из режима редактирования</button>
        </div>
        <section class="car_data">
          <h4>Данные машины</h4>
          <div class="car_data_noedit" v-if="!this.editCar">
            <div class="car_data_item">
              <span class="data">Название:</span>
              <span class="text">{{car.name}}</span>
            </div>
            <div class="car_data_item">
              <span class="data">Тип машины:</span>
              <span class="text">{{car.type}}</span>
            </div>
            <div class="car_data_item">
              <span class="data">Количество мест:</span>
              <span class="text">{{car.sits}}</span>
            </div>
            <div class="car_data_item">
              <span class="data">Топливо:</span>
              <span class="text">{{car.fuel}}</span>
            </div>
            <div class="car_data_item">
              <span class="data">Цена/км:</span>
              <span class="text">{{car.price}}</span>
            </div>
            <div class="car_data_item">
              <span class="data">Дети:</span>
              <span class="text" v-if="car.child">Есть детское кресло</span>
              <span class="text" v-if="!car.child">Нет детского кресла</span>
            </div>
            <button
              type="button"
              class="btn btn-outline-dark"
              @click.prevent="toggleEditCar"
            >Редактировать</button>
          </div>
          <div class="car_data_noedit" v-if="this.editCar">
            <div class="car_data_item">
              <span class="data">Название:</span>
              <input class="main_input" type="text" v-model="car.name" />
            </div>
            <div class="car_data_item">
              <span class="data">Тип машины:</span>
              <select v-model="car.type">
                <option selected v-bind:value="car.type">{{car.type}}</option>
                <option
                  v-for="option in typesModel"
                  v-bind:key="random(option)"
                  v-bind:value="option"
                >{{option}}</option>
              </select>
            </div>
            <div class="car_data_item">
              <span class="data">Количество мест:</span>
              <input class="main_input w50" type="text" v-model="car.sits" />
            </div>
            <div class="car_data_item">
              <span class="data">Топливо:</span>
              <select v-model="car.fuel">
                <option selected v-bind:value="car.fuel">{{car.fuel}}</option>
                <option
                  v-for="option in typesFuel"
                  v-bind:key="random(option)"
                  v-bind:value="option"
                >{{option}}</option>
              </select>
            </div>
            <div class="car_data_item">
              <span class="data">Цена/км:</span>
              <input class="main_input w50" type="text" v-model="car.price" />
            </div>
            <div class="car_data_item">
              <span class="data">Детское кресло:</span>
              <select v-model="selected.child">
                <option v-if="car.child" selected value="Есть">Есть</option>
                <option v-if="car.child" value="Нет">Нет</option>
                <option v-if="!car.child" selected value="Нет">Нет</option>
                <option v-if="!car.child" value="Есть">Есть</option>
              </select>
            </div>
            <button
              type="button"
              class="btn btn-outline-primary btn_edit"
              @click.prevent="updateCar"
            >Сохранить</button>
            <button
              type="button"
              class="btn btn-outline-dark btn_edit"
              @click.prevent="toggleEditCar"
            >Отмена</button>
          </div>
        </section>
        <section class="driver_car">
          <div class="driver_car_container">
            <p>Вид сзади</p>
            <figure>
              <img :src="this.carphotos.car_photo_back" alt="car side" />
            </figure>
            <input type="file" @change="imageCarBackChanged" />
            <button
              class="btn btn-outline-primary mt-2"
              @click.prevent="updateCarPhotosBack"
            >Сохранить</button>
          </div>
          <div class="driver_car_container">
            <p>Вид сбоку</p>
            <figure>
              <img :src="this.carphotos.car_photo_side" alt="car_back" />
            </figure>
            <input type="file" @change="imageCarSideChanged" />
            <button
              class="btn btn-outline-primary mt-2"
              @click.prevent="updateCarPhotosSide"
            >Сохранить</button>
          </div>
          <div class="driver_car_container">
            <p>Вид спереди</p>
            <figure>
              <img :src="this.carphotos.car_photo_front" alt="car front" />
            </figure>
            <input type="file" @change="imageCarFrontChanged" />
            <button
              class="btn btn-outline-primary mt-2"
              @click.prevent="updateCarPhotosFront"
            >Сохранить</button>
          </div>
        </section>
        <div class="data-block" v-if="!editRouts">
          <button class="btn btn-primary" @click.prevent="toggleEditRouts">Изменить маршруты</button>
        </div>
        <div class="d-flex justify-content-center flex-wrap w-100" v-if="editRouts">
          <div class="routs_item_width">
            <AutoInput
              :inputText="routeGroupName"
              :items="nameRouteGroups"
              :returnData="postRouteName"
            ></AutoInput>
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
            <button class="btn btn-primary mt-4" @click.prevent="toggleEditRouts">Выйти</button>
          </div>
        </div>

        <section class="d-flex align-items-center flex-column reviews">
          <h3 class="mb-4">Отзывы</h3>
          <AddTour :updateItem="getReview" :driver_id="driver.id"></AddTour>
          <Review
            v-bind:key="random(item)"
            v-for="item in reviews.slice().reverse()"
            :name="item.author"
            :date="item.updated_at"
            :stars="item.rating"
            :description="item.text"
            :id="item.id"
            :driver_id="driver.id"
            :updateItem="getReview"
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
import AddTour from "../custom/AddTour";
import AutoInput from "../custom/AutoInput";

export default {
  name: "Driver",
  components: {
    Goback,
    LoadingSpinner,
    CarBlock,
    Spinner,
    Review,
    RouteItem,
    AddTour,
    AutoInput
  },
  props: ["id"],

  data() {
    return {
      reviews: [],
      routegroups: [],
      nameRouteGroups: [],
      routeGroupName: "",
      loading: {
        data: false
      },
      driver: {
        id: "",
        name: "",
        last_name: "",
        photo: "",
        phone: ""
      },
      car: {
        id: "",
        name: "",
        type: "",
        sits: "",
        fuel: "",
        price: "",
        child: "",
        driver: ""
      },
      carphotos: {
        car_photo_side: "",
        car_photo_back: "",
        car_photo_front: ""
      },
      types: {
        cartypes: ["Седан", "Внедорожник", "Минивэн", "Хэтчбэк"],
        fueltypes: ["Газ", "Дизель", "Бензин"]
      },
      postphoto: {
        id: "",
        photo: ""
      },
      editMode: false,
      editCar: false,
      editRouts: false,
      selected: {
        child: "",
        fuel: "",
        type: ""
      },
      imageSelected: null
    };
  },
  async created() {
    await this.getDriver();
    await this.getCar();
    await this.getCarPhotos();
    await this.getReview();
    await this.getRouteGroups();
    await this.getRotesNames();
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
    async getCar() {
      await fetch(`/api/driver/car/get_car/${this.id}`)
        .then(res => res.json())
        .then(res => (this.car = res))
        .catch(err => console.log(err));

      if (this.car.child == 1) this.selected.child = "Есть";
      else this.selected.child = "Нет";
    },
    async getCarPhotos() {
      await fetch(`/api/carphoto/${this.car.id}`)
        .then(res => res.json())
        .then(res => (this.carphotos = res.data))
        .catch(err => console.log(err));
      this.postphoto.id = this.car.id;
    },
    async getRouteGroups() {
      await fetch("/api/driver/rg/show_connected/" + this.id)
        .then(res => res.json())
        .then(res => {
          this.routegroups = res;
        })
        .catch(err => console.warn(err));
    },
    async getRotesNames() {
      let cashRoutes = "";
      await fetch("/api/route_group/groups")
        .then(res => res.json())
        .then(res => {
          cashRoutes = res.data;
        })
        .catch(err => console.warn(err));

      this.nameRouteGroups = cashRoutes.map(x => x.name);
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
        window.location.href = "/home/drivers";
      }
    },
    async connectRG() {
      await fetch(
        `/api/driver/rg/connect/` + this.id + `/` + this.routeGroupName,
        {
          method: "post"
        }
      )
        .then(res => res.json())
        .then(data => {
          alert(`Роут группа успешно добавлена`);
          this.getRouteGroups();
          this.routeGroupName = "";
        })
        .catch(err => console.log(err));
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
        })
        .catch(err => console.log(err));
      this.getDriver();
      this.toggleEditMode();
    },
    async updateCar() {
      let car = this.car;
      if (this.selected.child == "Есть") car.child = 1;
      else car.child = 0;
      await fetch(`/api/car/`, {
        method: "put",
        body: JSON.stringify(car),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`${this.driver.name} обновлен`);
          this.toggleEditCar();
        })
        .catch(err => console.log(err));
      this.getCar();
    },
    async updateCarPhotosBack() {
      let carphotos = this.carphotos;
      let postphoto = this.postphoto;
      postphoto.photo = carphotos.car_photo_back;
      postphoto.id = this.car.id;
      await fetch(`/api/carphoto/back`, {
        method: "put",
        body: JSON.stringify(postphoto),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`машина обновлена`);
          window.location.href = "/home/driver/" + driver.id;
        })
        .catch(err => console.log(err));
    },
    async updateCarPhotosSide() {
      let carphotos = this.carphotos;
      let postphoto = this.postphoto;
      postphoto.photo = carphotos.car_photo_side;
      postphoto.id = this.car.id;
      await fetch(`/api/carphoto/side`, {
        method: "put",
        body: JSON.stringify(postphoto),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`машина обновлена`);
          window.location.href = "/home/driver/" + driver.id;
        })
        .catch(err => console.log(err));
    },
    async updateCarPhotosFront() {
      let carphotos = this.carphotos;
      let postphoto = this.postphoto;
      postphoto.photo = carphotos.car_photo_front;
      postphoto.id = this.car.id;
      await fetch(`/api/carphoto/front`, {
        method: "put",
        body: JSON.stringify(postphoto),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`машина обновлена`);
          window.location.href = "/home/driver/" + driver.id;
        })
        .catch(err => console.log(err));
    },
    postRouteName(item) {
      this.routeGroupName = item;
    },
    random(item) {
      return Math.random();
    },
    toggleEditMode() {
      this.editMode = !this.editMode;
    },
    toggleEditRouts() {
      this.editRouts = !this.editRouts;
    },
    toggleEditCar() {
      this.editCar = !this.editCar;
    },
    onImageSelected(e) {
      this.imageSelected = e.target.files[0];
    },
    imageDriverChanged(e) {
      let fileReader = new FileReader();

      fileReader.readAsDataURL(e.target.files[0]);

      fileReader.onload = e => {
        this.driver.photo = e.target.result;
      };
    },
    imageCarBackChanged(e) {
      let fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0]);

      fileReader.onload = e => {
        this.carphotos.car_photo_back = e.target.result;
      };
    },
    imageCarSideChanged(e) {
      let fileReader = new FileReader();

      fileReader.readAsDataURL(e.target.files[0]);

      fileReader.onload = e => {
        this.carphotos.car_photo_side = e.target.result;
      };
    },
    imageCarFrontChanged(e) {
      let fileReader = new FileReader();

      fileReader.readAsDataURL(e.target.files[0]);

      fileReader.onload = e => {
        this.carphotos.car_photo_front = e.target.result;
      };
    }
  },
  computed: {
    typesFuel: function() {
      let fuel = this.car.fuel;
      return this.types.fueltypes.filter(item => item != fuel);
    },
    typesModel: function() {
      let model = this.car.type;
      return this.types.cartypes.filter(item => item != model);
    }
  }
};
</script>

<style scoped>
</style>


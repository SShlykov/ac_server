<template>
  <div class="w-100">
    <div class="d-flex align-items-center row">
      <h2>{{title}}</h2>
      <div v-if="title=='Водители'">
        <a class="ml-2" href="/home/drivers/deleted">К Спрятанным водителям</a>
      </div>
      <div v-if="title=='Маршруты'">
        <a class="ml-4" href="#">К Спрятанным маршрутам</a>
        <a class="ml-4" href="/home/routs/edit">Создать новую группу точек</a>
      </div>
    </div>
    <div v-if="data.loading" class="loading">
      <div
        class="card d-flex flex-wrap justify-content-center align-items-center container-fluid w-100"
      >
        <Spinner></Spinner>
      </div>
    </div>
    <div class="toggleForm">
      <input type="checkbox" />
      <div class="d-flex flex-wrap container-fluid w-100 item_visible">
        <FormAddItem
          :fields="this.data.keys"
          :path="this.path"
          :fetchData="fetchData"
          v-if="this.data.keys"
          :returnImage="this.getNewDriverImage"
        />
        <figure v-if="title=='Водители'" class="driver-view-photo">
          <img v-bind:src="default_image" alt="new_driver_image" />
        </figure>
      </div>
    </div>
    <div class="d-flex flex-wrap container-fluid w-100" v-if="!data.loading">
      <div
        class="card card-body m-1"
        v-for="item in data.list"
        v-bind:key="item.id"
        style="width: 18rem;"
      >
        <slot
          :item="item"
          :fetchData="fetchData"
          :destroyItem="destroyItem"
          :deleteItem="deleteItem"
        />
      </div>
      <Pagination
        :pagination="this.data.pagination"
        :fetchData="fetchData"
        v-if="this.data.pagination.current_page"
      />
    </div>
  </div>
</template>

<script>
import FormAddItem from "../FormAddItem/FormAddItem";
import Pagination from "../Pagination/Pagination";
import Spinner from "../spinner";
import Goback from "../goback";

export default {
  name: "DataBlock",
  components: { Goback, Spinner, Pagination, FormAddItem: FormAddItem },
  props: {
    title: {
      required: true
    },
    path: {
      required: true
    }
  },
  data() {
    return {
      data: {
        id: "",
        list: [],
        keys: null,
        curr_item: {},
        pagination: {},
        edit: false,
        showAddForm: false,
        loading: true
      },
      default_image:
        "https://sun9-38.userapi.com/c854320/v854320805/1b8e14/afhOhLK6rkU.jpg"
    };
  },
  async created() {
    await this.fetchData();
    this.data.loading = false;
  },
  methods: {
    async fetchData(page_url) {
      this.data.loading = true;
      let vm = this;
      page_url = page_url || `/api/${this.path}/6`;
      await fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.data.list = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.warn(err));
      await this.getKeys();
      this.data.loading = false;
    },
    makePagination(meta, links) {
      this.data.pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
    },
    getKeys() {
      this.data.keys = Object.keys(this.data.list[0]);
    },
    getNewDriverImage(item) {
      this.default_image = item;
    },
    showAddForm() {
      this.data.loading = false;
      this.data.showAddForm = true;
    },
    deleteItem(id) {
      if (confirm("Вы точно хотите спрятать?")) {
        fetch(`/api/${this.path.slice(0, -1)}/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`Выполнено`);
            this.fetchData();
          })
          .catch(err => console.log(err));
      }
    },
    destroyItem(id) {
      if (confirm("Вы точно хотите удалить?")) {
        fetch(`/api/${this.path.slice(0, -1)}/delete/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`Водитель удален`);
            this.fetchData();
          })
          .catch(err => console.log(err));
      }
    },
    deleteRoute(id) {
      if (confirm("Вы точно хотите удалить точку?")) {
        fetch(`/api/route/` + id, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert(`Точка удалена`);
            this.fetchData();
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>
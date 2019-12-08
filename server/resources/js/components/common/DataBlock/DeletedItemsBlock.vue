<template>
  <div class="w-100">
    <div class="d-flex align-items-center row">
      <h2>{{title}}</h2>
      <div v-if="title=='Водители'">
        <a href="http://ac/home/drivers/">К Видимым водителям</a>
      </div>
    </div>
    <div v-if="data.loading" class="loading">
      <div
        class="card d-flex flex-wrap justify-content-center align-items-center container-fluid w-100"
      >
        <Spinner></Spinner>
      </div>
    </div>
    <div class="d-flex flex-wrap container-fluid w-100" v-if="!data.loading">
      <div
        class="card card-body m-1"
        v-for="item in data.list"
        v-bind:key="item.id"
        style="width: 18rem;"
      >
        <slot :item="item" :restoreItem="restoreItem" />
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
import Pagination from "../Pagination/Pagination";
import Spinner from "../spinner";
import Goback from "../goback";

export default {
  name: "DataBlock",
  components: { Goback, Spinner, Pagination },
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
      }
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
      page_url = page_url || `/api/driver/onlyTrashed/6`;
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
    showAddForm() {
      this.data.loading = false;
      this.data.showAddForm = true;
    },
    restoreItem(id) {
      if (confirm("Вы точно хотите восстановить?")) {
        fetch(`/api/driver/restore/${id}`, {
          method: "put"
        })
          .then(res => res.json())
          .then(data => {
            alert(`${this.name} восстановлен`);
            this.fetchData();
          })
          .catch(err => console.log(err));
      }
    }
  }
};
</script>


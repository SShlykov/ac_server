<template>
  <div class="page_container">
    <h2 class="tour_title">Заказы</h2>
    <div class="notice">
      <NoticeCard
        v-for="item in data"
        :fetchData="getNotices"
        :data="item"
        v-bind:key="random(item)"
      />
    </div>
  </div>
</template>

<script>
import NoticeCard from "../custom/NoticeCard.vue";

export default {
  name: "Notices",
  components: { NoticeCard },
  data() {
    return {
      data: []
    };
  },
  props: {},
  async created() {
    await this.getNotices();
    console.log(this.data);
  },
  methods: {
    async addNotice() {
      const newNotice = {
        client_name: "Игорь",
        client_mail: "mail",
        client_phone: "+70999",
        client_address: "adress",
        transfer_date: "date",
        transfer_time: "20:30",
        transfer_price: 1000,
        driver_name: "Вася",
        driver_id: "4",
        status: "ОБРАБОТКА"
      };
      await fetch(`/api/notices/additem`, {
        method: "put",
        body: JSON.stringify(newNotice),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`Запись добавдена`);
          this.work = false;
        })
        .catch(err => console.log(err));
    },
    async getNotices() {
      await fetch(`/api/notices/getall`)
        .then(res => res.json())
        .then(res => (this.data = res))
        .catch(err => console.log(err));
    },
    random(item) {
      return Math.random().toString(36);
    }
  }
};
</script>

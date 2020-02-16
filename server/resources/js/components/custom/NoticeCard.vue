<template>
  <div class="notice-card">
    <ul v-if="!editCard">
      <li>Карточка заказа</li>
      <li>
        <span>Имя клиента:</span>
        <span>{{orderdData.client_name}}</span>
      </li>
      <li>
        <span>Почта клиента:</span>
        <span>{{orderdData.client_mail}}</span>
      </li>
      <li v-if="orderdData.client_phone!=='.'">
        <span>Телефон:</span>
        <span>{{orderdData.client_phone}}</span>
      </li>
      <li v-if="orderdData.client_address!=='.'">
        <span>Адрес:</span>
        <span>{{orderdData.client_address}}</span>
      </li>
      <li v-if="orderdData.transfer_date!=='.'">
        <span>Дата трансфера:</span>
        <span>{{orderdData.transfer_date}}</span>
      </li>
      <li v-if="orderdData.transfer_time!=='.'">
        <span>Время трансфера:</span>
        <span>{{orderdData.transfer_time}}</span>
      </li>
      <li v-if="orderdData.transfer_route!=='.'">
        <span>Маршрут:</span>
        <span>{{orderdData.transfer_route}}</span>
      </li>
      <li v-if="orderdData.transfer_price!==0">
        <span>Стоимость заказа:</span>
        <span>{{orderdData.transfer_price + '₽'}}</span>
      </li>
      <li v-if="orderdData.driver_name!=='.'">
        <span>Водитель:</span>
        <span>{{orderdData.driver_name}}</span>
      </li>
      <li>
        <span>Статус заказа:</span>
        <span>{{orderdData.status}}</span>
      </li>
      <!-- // -->
    </ul>
    <ul v-if="editCard">
      <li>Карточка заказа</li>
      <li>
        <span>Имя клиента:</span>
        <input v-model="orderdData.client_name" />
      </li>
      <li>
        <span>Почта клиента:</span>
        <input v-model="orderdData.client_mail" />
      </li>
      <li v-if="orderdData.client_phone!=='.'">
        <span>Телефон:</span>
        <input v-model="orderdData.client_phone" />
      </li>
      <li v-if="orderdData.client_address!=='.'">
        <span>Адрес:</span>
        <input v-model="orderdData.client_address" />
      </li>
      <li v-if="orderdData.transfer_date!=='.'">
        <span>Дата трансфера:</span>
        <input v-model="orderdData.transfer_date" />
      </li>
      <li v-if="orderdData.transfer_time!=='.'">
        <span>Время трансфера:</span>
        <input v-model="orderdData.transfer_time" />
      </li>
      <li v-if="orderdData.transfer_route!=='.'">
        <span>Маршрут:</span>
        <input v-model="orderdData.transfer_route" />
      </li>
      <li v-if="orderdData.transfer_price!=='.'">
        <span>Стоимость заказа:</span>
        <input v-model="orderdData.transfer_price" />
      </li>
      <li v-if="orderdData.driver_name!=='.'">
        <span>Водитель:</span>
        <input v-model="orderdData.driver_name" />
      </li>
      <li>
        <span>Статус заказа:</span>
        <input v-model="orderdData.status" />
      </li>
    </ul>
    <button
      v-if="!editCard"
      @click.prevent="toggleEditCatd"
      class="btn btn-outline-primary"
    >Изменить заказ</button>
    <div v-if="editCard">
      <button @click.prevent="updateItem" class="btn btn btn-primary">Сохранить</button>
      <button @click.prevent="toggleEditCatd" class="btn btn-outline-dark">Отменить</button>
      <button @click.prevent="deleteItem" class="btn btn-outline-danger">Удалить</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "NoticeCard",
  props: {
    data: {
      required: true
    },
    fetchData: {
      required: true
    }
  },
  data() {
    return {
      editCard: false,
      routePathMain: "123",
      routePathSecond: "",
      orderdData: {
        client_name: "",
        client_mail: "",
        client_phone: "",
        client_address: "",
        transfer_date: "",
        transfer_time: "",
        transfer_route: "",
        transfer_price: "",
        driver_name: "",
        driver_id: "",
        status: ""
      }
    };
  },
  async created() {
    // console.log(this.data);
    await this.parseData();
  },
  methods: {
    toggleEditCatd() {
      this.editCard = !this.editCard;
    },
    async updateItem() {
      await fetch(`/api/notices/updateitem`, {
        method: "put",
        body: JSON.stringify(this.orderdData),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`Запись обновлена`);
          this.work = false;
        })
        .catch(err => console.log(err));
      this.fetchData();
      this.toggleEditCatd();
    },
    async deleteItem() {
      await fetch(`/api/notices/deleteitem`, {
        method: "delete",
        body: JSON.stringify(this.orderdData),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`Запись удалена`);
          this.work = false;
        })
        .catch(err => console.log(err));
      this.fetchData();
    },
    async parseData() {
      const dataKeys = Object.keys(this.data);
      dataKeys.forEach(el => (this.orderdData[el] = this.data[el]));
      this.routePathMain = this.data.transfer_route;
      if (this.routePathMain.length > 30) {
        this.routePathSecond = this.routePathMain.slice(
          20,
          this.routePathMain.length
        );
        this.routePathMain = this.routePathMain.slice(0, 30);
      }
    }
  },
  components: {}
};
</script>
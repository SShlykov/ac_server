<template>
<div class="w-100">
    <h2>Водители</h2>
    <div class="d-flex flex-wrap container-fluid w-100">
        <div class="card card-body m-1" v-for="driver in drivers" v-bind:key="driver.id" style="width: 18rem;">
            <img :src="driver.photo" :alt="'driver-' + driver.id" class="card-img-top">
            <h3>Водитель {{driver.name + " " + driver.last_name}}</h3>
            <p>Находится в {{driver.locale}}</p>
            <p>Телефон - {{driver.phone}}</p>
        </div>
        <nav aria-label="Page navigation example" class="w-100 d-flex justify-content-end">
            <ul class="pagination">
                <li :class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchDrivers(pagination.prev_page_url)">
                        Предыдущий
                    </a>
                </li>
                <li :class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchDrivers(pagination.next_page_url)">
                        Следующий
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</template>

<script>
  export default {
    data() {
        return{
            drivers: [],
            driver:{
                id:'',
                name: '',
                last_name: '',
                phone: '',
                locale: '',
                photo: ''
            },
            driver_id: '',
            pagination: {},
            edit: false
        }
    },

    created() {
      this.fetchDrivers();
    },
    methods: {
      fetchDrivers(page_url) {
        let vm = this;
        page_url = page_url || '/api/drivers'
        fetch(page_url)
          .then(res => res.json())
          .then(res => {
            this.drivers =res.data;
            vm.makePagination(res.meta, res.links);
          })
          .catch(err => console.warn(err));
      },
      makePagination(meta, links){
        let pagination = {
            current_page: meta.current_page,
            last_page: meta.last_page,
            next_page_url: links.next,
            prev_page_url: links.prev
        }

        this.pagination = pagination;
      }
    }
  }
</script>

<style scoped>

</style>

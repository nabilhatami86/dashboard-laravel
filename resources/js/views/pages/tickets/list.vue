<template>
    <div>
      <div class="filters">
        <input v-model="filters.search" @input="getTickets" placeholder="Cari tiket..." />
        <select v-model="filters.status" @change="getTickets">
          <option value="">Semua Status</option>
          <option v-for="status in statusList" :key="status" :value="status">
            {{ status }}
          </option>
        </select>
      </div>
  
      <table>
        <thead>
          <tr>
            <th>Subjek</th>
            <th>Dibuat</th>
            <th>Terakhir Diperbarui</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="ticket in ticketList" :key="ticket.id">
            <td>
              <a :href="`/tickets/${ticket.id}`">{{ ticket.subject }}</a>
              <span v-if="newMessages[ticket.id] > 0" class="badge badge-danger">
                {{ newMessages[ticket.id] }} Pesan Baru
              </span>
            </td>
            <td>{{ ticket.created_at | momentFormatDate }}</td>
            <td>{{ ticket.updated_at | momentFormatDateTimeAgo }}</td>
            <td>{{ ticket.status }}</td>
          </tr>
        </tbody>
      </table>
  
      <div class="pagination">
        <button @click="changePage(pagination.currentPage - 1)" :disabled="pagination.currentPage === 1">
          &laquo; Sebelumnya
        </button>
        <button @click="changePage(pagination.currentPage + 1)" :disabled="pagination.currentPage === totalPages">
          Selanjutnya &raquo;
        </button>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        loading: false,
        ticketList: [],
        statusList: ["open", "closed", "in progress"],
        filters: {
          search: "",
          status: null,
        },
        sort: {
          column: "updated_at",
          order: "desc",
        },
        pagination: {
          currentPage: 1,
          perPage: 10,
          total: 0,
        },
        newMessages: {}, // Untuk menyimpan jumlah pesan baru per tiket
      };
    },
    computed: {
      totalPages() {
        return Math.ceil(this.pagination.total / this.pagination.perPage);
      },
    },
    methods: {
      async getTickets() {
        this.loading = true;
        try {
          const response = await axios.get("/api/tickets", {
            params: {
              page: this.pagination.currentPage,
              perPage: this.pagination.perPage,
              search: this.filters.search,
              status: this.filters.status,
              sortColumn: this.sort.column,
              sortOrder: this.sort.order,
            },
          });
  
          this.ticketList = response.data.tickets;
          this.pagination.total = response.data.total;
  
          // Simpan jumlah pesan baru berdasarkan ID tiket
          this.newMessages = response.data.tickets.reduce((acc, ticket) => {
            acc[ticket.id] = ticket.new_messages || 0;
            return acc;
          }, {});
        } catch (error) {
          console.error("Error loading tickets:", error);
        } finally {
          this.loading = false;
        }
      },
      changePage(page) {
        if (page < 1 || page > this.totalPages) return;
        this.pagination.currentPage = page;
        this.getTickets();
      },
    },
    mounted() {
      this.getTickets();
    },
    filters: {
      momentFormatDate(value) {
        return new Date(value).toLocaleDateString();
      },
      momentFormatDateTimeAgo(value) {
        return new Date(value).toLocaleString();
      },
    },
  };
  </script>
  
  <style>
  .badge {
    display: inline-block;
    padding: 0.25em 0.5em;
    font-size: 0.75rem;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
  }
  
  .badge-danger {
    color: #fff;
    background-color: #dc3545;
  }
  </style>
  
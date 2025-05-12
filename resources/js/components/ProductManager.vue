<template>
  <div>
    <h2>Produtos</h2>
    <div class="alert alert-info">
      Gerencie seus produtos aqui. Você pode adicionar, editar ou excluir produtos.
    </div>

    <div class="mb-3">
      <button class="btn btn-success" @click="openModal()">+ Adicionar Produto</button>
    </div>

    <!-- Tabela -->
    <div class="card">
      <div class="card-header">
        <h5>Lista de Produtos</h5>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Preço</th>
              <th>Categoria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in products" :key="p.id">
              <td>{{ p.name }}</td>
              <td>R$ {{ p.price }}</td>
              <td>{{ p.category }}</td>
              <td>
                <button @click="editProduct(p)" class="btn btn-sm btn-info">Editar</button>
                <button @click="deleteProduct(p.id)" class="btn btn-sm btn-danger ml-2">Excluir</button>
              </td>
            </tr>
            <tr v-if="products.length === 0">
              <td colspan="4" class="text-center">Nenhum produto cadastrado</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" :class="{ show: showModal }" style="display: block;" v-if="showModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="saveProduct">
            <div class="modal-header">
              <h5 class="modal-title">{{ product.id ? 'Editar Produto' : 'Adicionar Produto' }}</h5>
              <button type="button" class="close" @click="closeModal">&times;</button>
            </div>
            <div class="modal-body">
              <input v-model="product.name" class="form-control mb-2" placeholder="Nome">
              <input v-model="product.price" type="number" step="0.01" class="form-control mb-2" placeholder="Preço">
              <input v-model="product.category" type="text" class="form-control mb-2" placeholder="Categoria">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal">Cancelar</button>
              <button type="submit" class="btn btn-primary">
                {{ product.id ? 'Atualizar' : 'Adicionar' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Backdrop -->
    <div class="modal-backdrop fade show" v-if="showModal"></div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      products: [],
      product: {
        id: null,
        name: '',
        price: '',
        category: ''
      },
      showModal: false
    }
  },
  mounted() {
    this.fetchProducts();
  },
  methods: {
    async fetchProducts() {
      const response = await axios.get('/api/products');
      this.products = response.data;
    },
    async saveProduct() {
      if (this.product.id) {
        await axios.put(`/api/products/${this.product.id}`, this.product);
      } else {
        await axios.post('/api/products', this.product);
      }
      this.fetchProducts();
      this.closeModal();
    },
    editProduct(prod) {
      this.product = { ...prod };
      this.showModal = true;
    },
    deleteProduct(id) {
      if (confirm("Tem certeza que deseja excluir?")) {
        axios.delete(`/api/products/${id}`).then(() => this.fetchProducts());
      }
    },
    openModal() {
      this.resetForm();
      this.showModal = true;
    },
    closeModal() {
      this.resetForm();
      this.showModal = false;
    },
    resetForm() {
      this.product = { id: null, name: '', price: '', category: '' };
    }
  }
}

</script>

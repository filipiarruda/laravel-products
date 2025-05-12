<template>
  <div>
    <h2>Produtos</h2>
    <div class="row">
        <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    Gerencie seus produtos aqui. Você pode adicionar, editar ou excluir produtos.
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Adicionar/Editar Produto</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="saveProduct" class="mb-4">
                    <div class="form-row">
                        <input v-model="product.name" class="form-control col mr-2" placeholder="Nome">
                        <input v-model="product.price" type="number" step="0.01" class="form-control col mr-2" placeholder="Preço">
                        <input v-model="product.category" type="text" class="form-control col mr-2" placeholder="Categoria">
                        <button class="btn btn-primary col-2" type="submit">
                        {{ product.id ? 'Atualizar' : 'Adicionar' }}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
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
    </div>
  </div>
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
      }
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
      this.resetForm();
      this.fetchProducts();
    },
    editProduct(prod) {
      this.product = { ...prod };
    },
    async deleteProduct(id) {
      if (confirm("Tem certeza que deseja excluir?")) {
        await axios.delete(`/api/products/${id}`);
        this.fetchProducts();
      }
    },
    resetForm() {
      this.product = { id: null, name: '', price: '', category: '' };
    }
  }
}
</script>

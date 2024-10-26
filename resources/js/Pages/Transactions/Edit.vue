<template>
    <div class="container">
        <h1 class="title">Редактировать транзакцию</h1>
        <form @submit.prevent="update" class="form">
            <div class="form-group">
                <label>Категория:</label>
                <select v-model="form.category" required class="form-control">
                    <option value="income" :selected="transaction.category === 'income'">Доход</option>
                    <option value="expense" :selected="transaction.category === 'expense'">Расход</option>
                </select>
            </div>
            <div class="form-group">
                <label>Сумма:</label>
                <input v-model="form.amount" type="number" step="0.01" required class="form-control" />
            </div>
            <div class="form-group">
                <label>Дата:</label>
                <input v-model="form.date" type="date" required class="form-control" />
            </div>
            <div class="form-group">
                <label>Описание:</label>
                <textarea v-model="form.description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn">Сохранить</button>
            <a href="/transaction" class="link">Назад</a>
        </form>
    </div>
</template>

<style scoped>
.container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
}

.title {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn:hover {
    background-color: #218838;
}

.link {
    display: inline-block;
    margin-top: 10px;
    text-align: center;
    color: #007bff;
    text-decoration: none;
}

.link:hover {
    text-decoration: underline;
}
</style>

<script>
export default {
    props: {
        transaction: Object,
    },
    data() {
        return {
            form: { ...this.transaction },
        };
    },
    methods: {
        async update() {
            await this.$inertia.put(`/transaction/${this.transaction.id}`, this.form);
        },
    },
};
</script>

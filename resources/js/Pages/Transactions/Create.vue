<template>
    <div class="container">
        <h1 class="title">Создать транзакцию</h1>
        <form @submit.prevent="submit" class="form">
            <div class="form-group">
                <label for="category">Категория:</label>
                <select v-model="form.category" id="category" required class="form-control">
                    <option value="" disabled>Выберите категорию</option>
                    <option value="income">Доход</option>
                    <option value="expense">Расход</option>
                </select>
            </div>
            <div class="form-group">
                <label for="amount">Сумма:</label>
                <input type="number" v-model="form.amount" id="amount" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="date">Дата:</label>
                <input type="date" v-model="form.date" id="date" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="description">Описание:</label>
                <textarea v-model="form.description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn">Сохранить</button>
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
</style>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    data() {
        return {
            form: {
                category: '',
                amount: '',
                date: '',
                description: '',
            },
        };
    },
    methods: {
        async submit() {
            await Inertia.post('/transaction', this.form);
        },
    },
};
</script>

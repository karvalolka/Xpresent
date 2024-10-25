<template>
    <div>
        <h1>Создать транзакцию</h1>
        <form @submit.prevent="submit">
            <div>
                <label for="category">Категория:</label>
                <select v-model="form.category" id="category" required>
                    <option value="" disabled>Выберите категорию</option>
                    <option value="income">Доход</option>
                    <option value="expense">Расход</option>
                </select>
            </div>
            <div>
                <label for="amount">Сумма:</label>
                <input type="number" v-model="form.amount" id="amount" required />
            </div>
            <div>
                <label for="date">Дата:</label>
                <input type="date" v-model="form.date" id="date" required />
            </div>
            <div>
                <label for="description">Описание:</label>
                <textarea v-model="form.description" id="description"></textarea>
            </div>
            <button type="submit">Сохранить</button>
        </form>
    </div>
</template>

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

<template>
    <div>
        <h1>Редактировать транзакцию</h1>
        <form @submit.prevent="update">
            <div>
                <label>Категория:</label>
                <select v-model="form.category" required>
                    <option value="income" :selected="transaction.category === 'income'">Доход</option>
                    <option value="expense" :selected="transaction.category === 'expense'">Расход</option>
                </select>
            </div>
            <div>
                <label>Сумма:</label>
                <input v-model="form.amount" type="number" step="0.01" required />
            </div>
            <div>
                <label>Дата:</label>
                <input v-model="form.date" type="date" required />
            </div>
            <div>
                <label>Описание:</label>
                <textarea v-model="form.description"></textarea>
            </div>
            <button type="submit">Сохранить</button>
            <a href="/transaction">Назад</a>
        </form>
    </div>
</template>

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

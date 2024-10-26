<template>
    <div class="transaction-list">
        <h1>Транзакции</h1>
        <a class="btn" href="/transaction/create">Добавить транзакцию</a>

        <div class="filter">
            <label for="startDate">С начала:</label>
            <input type="date" v-model="startDate" @change="filterTransactions" />
            <label for="endDate">По конец:</label>
            <input type="date" v-model="endDate" @change="filterTransactions" />
            <button @click="filterTransactions">Применить</button>
        </div>

        <div class="summary">
            <h2>Итого</h2>
            <p>Доходы: {{ totalIncome }} руб.</p>
            <p>Расходы: {{ totalExpense }} руб.</p>
        </div>

        <table>
            <thead>
            <tr>
                <th>Категория</th>
                <th>Сумма</th>
                <th>Дата</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="transaction in filteredTransactions" :key="transaction.id">
                <td>{{ transaction.category }}</td>
                <td>{{ transaction.amount }}</td>
                <td>{{ transaction.date }}</td>
                <td>{{ transaction.description }}</td>
                <td>
                    <a class="btn-edit" :href="`/transaction/${transaction.id}/edit`">Редактировать</a>
                    <form @submit.prevent="destroy(transaction.id)" class="form-delete">
                        <button type="submit" class="btn-delete">Удалить</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        transactions: Array,
    },
    data() {
        return {
            startDate: '',
            endDate: '',
            filteredTransactions: this.transactions,
        };
    },
    computed: {
        totalIncome() {
            return this.filteredTransactions.filter(t => t.category === 'income').reduce((sum, t) => sum + t.amount, 0);
        },
        totalExpense() {
            return this.filteredTransactions.filter(t => t.category === 'expense').reduce((sum, t) => sum + t.amount, 0);
        },
    },
    methods: {
        async destroy(id) {
            if (confirm('Вы уверены, что хотите удалить эту транзакцию?')) {
                await this.$inertia.delete(`/transaction/${id}`);
                this.filteredTransactions = this.filteredTransactions.filter(transaction => transaction.id !== id);
            }
        },
        filterTransactions() {
            const start = this.startDate ? new Date(this.startDate) : null;
            const end = this.endDate ? new Date(this.endDate) : null;

            this.filteredTransactions = this.transactions.filter(transaction => {
                const transactionDate = new Date(transaction.date);
                return (!start || transactionDate >= start) && (!end || transactionDate <= end);
            });
        },
    },
    mounted() {
        this.filteredTransactions = this.transactions;
    },
};
</script>

<style scoped>
.transaction-list {
    padding: 20px;
}

.btn {
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    display: inline-block;
}

.btn-edit {
    margin-right: 5px;
    background-color: #2196F3;
}

.btn-delete {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
}

.filter {
    margin-bottom: 20px;
}

.summary {
    margin-bottom: 20px;
    background-color: #e9ecef;
    padding: 10px;
    border-radius: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}
</style>

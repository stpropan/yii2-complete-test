
// Ожидание загрузки jQuery
window.addEventListener('load', () => {
    
    // Таблица городов
    const citiesTable = $('#cities');
    
    // Кнопки стран
    const countries = $('[data-country-id]');

    // Событие по клику на страны
    countries.click((e) => {
        e.preventDefault();

        // Получение кнопки, на которую был добавлен хендлер
        const button = $(e.currentTarget);
        
        // Удаление запрета на нажатие для всех кнопок стран
        countries.removeClass('disabled');
        countries.attr('disabled', null);

        // Запрет на нажатие текущей нажатой кнопки
        button.addClass('disabled');
        button.attr('disabled', true);

        // Получение id из дата атрибута
        const countryId = e.currentTarget.dataset.countryId;

        // Отправление запроса на сервер, чтобы узнать города
        $.ajax({
            url: '/country/cities?id=' + countryId,
            method: 'GET',
            success: function (response) {

                // Приведение JSON строки к JS объекту
                const data = JSON.parse(response);
                
                // Если дата валидно преобразовалась в массив
                if (Array.isArray(data)) {
                    let htmlData = '';
                    
                    // Для каждого города
                    data.forEach((city) => {
                    
                        // Создание строки таблицы
                        htmlData += '<tr><td>' + city.name + '</td></tr>'
                    
                    });

                    // Добавление контента в таблицу
                    citiesTable.find('tbody').html(htmlData);

                    // Появление таблицы
                    citiesTable.removeClass('d-none');
                }
            }
        });
    });
});
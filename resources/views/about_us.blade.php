@extends('layouts.basic')

@section("title")
    О нас
@endsection

@section('content')
    <!-- Герой-секция (быстрый старт) -->
    <section class="myGrey py-4 py-md-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold" style="color: #001b44;">О техникуме <span class="myA">БТПИТ</span></h1>
                    <p class="lead mt-3">Государственное бюджетное профессиональное образовательное учреждение Воронежской области «Борисоглебский техникум промышленных и информационных технологий» — современное образовательное пространство, где готовят востребованных специалистов.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#specialties" class="btn btn-outline-secondary rounded-pill px-4 py-2"><i class="fas fa-graduation-cap me-2"></i>Специальности</a>
                        <a href="#advantages" class="btn btn-outline-secondary rounded-pill px-4 py-2"><i class="fas fa-star me-2"></i>Преимущества</a>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm">

                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-map-marker-alt fa-2x myA"></i>
                                <div><strong>Адрес:</strong><br>397160, Воронежская обл., г. Борисоглебск, ул. Третьяковская, д. 14</div>
                            </div>
                            <hr>
                            <div><i class="fas fa-calendar-alt me-2 myA"></i> <strong>Год основания:</strong> 2015 (слияние трёх колледжей)</div>
                            <div class="mt-2"><i class="fas fa-check-circle me-2 myA"></i> <strong>Аккредитация:</strong> государственная, статус СПО</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Основные сведения и контакты кратко -->
    <section class="container py-5">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <h3 class="h4 fw-bold"><i class="fas fa-info-circle myA me-2"></i> Ключевые факты</h3>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><i class="fas fa-users me-2 myA"></i> <strong>Контингент:</strong> более 1000 студентов</li>
                        <li class="mb-2"><i class="fas fa-building me-2 myA"></i> <strong>Площадь помещений:</strong> ~14 000 м²</li>
                        <li class="mb-2"><i class="fas fa-laptop-code me-2 myA"></i> <strong>Электронная среда:</strong> онлайн-курсы, методические пособия</li>
                        <li class="mb-2"><i class="fas fa-chalkboard-user me-2 myA"></i> <strong>Профессионалитет:</strong> федеральный проект ускоренной подготовки</li>
                    </ul>
                    <!-- ФОТО 2: Учебный процесс -->
                    <div class="photo-card mt-3">
                        <img src="{{asset('img/img113.jpg')}}" alt="Учебный процесс в БТПИТ" onerror="this.style.display='none'">
                        <div class="p-2 bg-light">
                            <small class="text-muted">Современные аудитории и лаборатории</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <h3 class="h4 fw-bold"><i class="fas fa-phone-alt myA me-2"></i> Контакты приёмной комиссии</h3>
                    <ul class="list-unstyled mt-3">
                        <li><i class="fas fa-phone me-2"></i> +7 (47354) 6-05-73, 6-06-98, 6-15-37</li>
                        <li class="mt-2"><i class="fas fa-envelope me-2"></i> btpit@govvrn.ru</li>
                        <li class="mt-2"><i class="fas fa-globe me-2"></i> <a href="https://btpit.obrvrn.ru/" class="myA" target="_blank">btpit.obrvrn.ru</a></li>
                    </ul>
                    <div class="alert alert-info mt-3 mb-0 py-2 small">
                        <i class="fas fa-info-circle"></i> Приём документов: на базе 9 класса, без экзаменов (конкурс аттестатов).
                    </div>
                    <!-- ФОТО 3: Приёмная комиссия -->
                    <div class="photo-card mt-3">
                        <img src="{{asset('img/img115.jpg')}}" alt="Приёмная комиссия БТПИТ" onerror="this.style.display='none'">
                        <div class="p-2 bg-light">
                            <small class="text-muted">Приёмная комиссия ждёт абитуриентов</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Таблица специальностей -->
    <section id="specialties" class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #001b44;">Направления обучения <i class="fas fa-microchip"></i></h2>
            <p class="lead">Среднее профессиональное образование (очная форма, база 9 класса)</p>
        </div>
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table table-bordered table-hover mb-0 align-middle table-specials">
                <thead class="text-center">
                <tr>
                    <th>Код</th>
                    <th>Специальность / Профессия</th>
                    <th>Срок обучения</th>
                </tr>
                </thead>
                <tbody>
                <tr><td>44.02.01</td><td>Дошкольное образование</td><td>3 года 10 мес.</td></tr>
                <tr><td>44.02.05</td><td>Коррекционная педагогика в начальном образовании</td><td>3 года 10 мес.</td></tr>
                <tr><td>38.02.01</td><td>Экономика и бухгалтерский учет (по отраслям)</td><td>2 года 10 мес.</td></tr>
                <tr><td>09.02.01</td><td>Компьютерные системы и комплексы</td><td>3 года 10 мес.</td></tr>
                <tr><td>09.02.07</td><td>Информационные системы и программирование</td><td>3 года 10 мес.</td></tr>
                <tr><td>15.02.16</td><td>Технология машиностроения</td><td>3 года 10 мес.</td></tr>
                <tr><td>40.02.04</td><td>Юриспруденция</td><td>2 года 10 мес.</td></tr>
                <tr><td>43.02.16</td><td>Туризм и гостеприимство</td><td>2 года 10 мес.</td></tr>
                <tr class="table-secondary fw-semibold"><td>15.01.05</td><td>Сварщик (ручная и частично механизированной сварки) — рабочая профессия</td><td>1 год 10 мес.</td></tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-muted small text-center">* Возможно обучение по программам подготовки квалифицированных рабочих, уточняйте в приёмной комиссии.</div>
    </section>

    <!-- Преимущества для студентов -->
    <section id="advantages" class="myGrey py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold"><i class="fas fa-medal myA"></i> Почему выбирают БТПИТ?</h2>
                <p class="lead">Лучшие условия для старта карьеры</p>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-gem fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Бюджетные места</h5>
                            <p class="text-muted">Обучение за счёт государства по большинству специальностей.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-shield-alt fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Отсрочка от армии</h5>
                            <p class="text-muted">Для студентов очной формы обучения.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-home fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Комфортное общежитие</h5>
                            <p class="text-muted">Иногородним студентам предоставляется место в общежитии.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-coins fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Стипендии</h5>
                            <p class="text-muted">Академические, социальные, именные, президентские.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-briefcase fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Практико-ориентированность</h5>
                            <p class="text-muted">Взаимодействие с работодателями, производственная практика.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-hover h-100 border-0 shadow rounded-4">
                        <div class="card-body text-center">
                            <i class="fas fa-rocket fa-3x myA mb-3"></i>
                            <h5 class="fw-bold">Профессионалитет</h5>
                            <p class="text-muted">Ускоренная подготовка кадров в рамках федерального проекта.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ФОТО 4: Мероприятия -->
            <div class="photo-card mt-5">
                <img src="{{asset('img/img116.jpg')}}" alt="Студенческие мероприятия в БТПИТ" class="photo-horizontal" onerror="this.style.display='none'">
                <div class="p-3 bg-light text-center">
                    <h5 class="mb-0">Яркая студенческая жизнь</h5>
                    <small class="text-muted">Концерты, спортивные соревнования, творческие вечера</small>
                </div>
            </div>
        </div>
    </section>

    <!-- Для кого подходит техникум + поступление -->
    <section class="container py-5">
        <div class="row g-5">
            <div class="col-md-6">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold mb-3"><i class="fas fa-user-check myA"></i> Кому подходит БТПИТ?</h3>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Выпускникам 9 классов, желающим получить профессию раньше сверстников.</li>
                        <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Тем, кто хочет работать в IT, машиностроении, педагогике, экономике, юриспруденции или туризме.</li>
                        <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Абитуриентам, ценящим практику и реальные рабочие задачи.</li>
                        <li class="list-group-item bg-transparent"><i class="fas fa-check-circle text-success me-2"></i> Тем, кто хочет получить отсрочку от армии и бюджетное образование.</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <h3 class="fw-bold mb-3"><i class="fas fa-file-signature myA"></i> Как поступить?</h3>
                    <p><strong>Формат приёма:</strong> на общедоступной основе, <span class="badge myLightBlue text-white">конкурс аттестатов</span> (без вступительных экзаменов).</p>
                    <p><strong>Способы подачи документов:</strong> лично в приёмную комиссию, по почте, через портал Госуслуг.</p>
                    <p><strong>Сроки приёма:</strong> обычно с июня, актуальную информацию уточняйте на сайте.</p>
                    <a href="https://btpit.obrvrn.ru/" target="_blank" class="btn myLightBlue text-white rounded-pill px-4 mt-2"><i class="fas fa-external-link-alt me-2"></i>Перейти на официальный сайт</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ГАЛЕРЕЯ ФОТО -->
    <section class="container py-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="color: #001b44;">Фотогалерея техникума</h2>
            <p class="lead">Мгновения из жизни БТПИТ</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('img/img112.jpg') }}" class="gallery-photo" onerror="this.style.display='none'">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('img/img117.jpg') }}" class="gallery-photo"  onerror="this.style.display='none'">
            </div>
            <div class="col-md-4 col-sm-6">
                <img src="{{ asset('img/img114.jpg') }}" class="gallery-photo"  onerror="this.style.display='none'">
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('img/img11.jpg') }}" class="gallery-photo"  onerror="this.style.display='none'">
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="{{ asset('img/img118.jpg') }}" class="gallery-photo" onerror="this.style.display='none'">
            </div>
        </div>
    </section>

    <!-- Отзывы студентов -->
    <section class="myGrey py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Что говорят студенты</h2>
                <p>Реальные отзывы из источника vuzopedia.ru</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg rounded-4 bg-white">
                        <div class="card-body p-4 p-md-5">
                            <i class="fas fa-quote-left quote-icon"></i>
                            <p class="fs-5 fst-italic mt-3">«Учусь в БТПИТ на 3 курсе на сварщика. Условия в техникуме хорошие. За время обучения было много практики. Это поможет мне в будущем.»</p>
                            <p class="fs-5 fst-italic border-top pt-3 mt-3">«Все преподаватели справедливые и готовы помочь в трудную минуту. После поступления я стала хорошо учиться, и у меня появилось еще больше друзей.»</p>
                            <div class="d-flex justify-content-end mt-3">
                                <span class="badge myLightBlue text-white p-2">Студенты БТПИТ</span>
                            </div>
                            <!-- ФОТО 10: Студенты -->
                            <div class="photo-card mt-4">
                                <img src="{{ asset('img/img119.jpg') }}" alt="Студенты БТПИТ" class="adaptive-photo" onerror="this.style.display='none'">
                                <div class="p-2 bg-light text-center">
                                    <small class="text-muted">Активные и целеустремлённые студенты БТПИТ</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Доп. информация: цифры, возможности -->
    <section class="container py-5">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <div class="stat-number">1000+</div>
                <div class="text-muted">студентов</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number">14 000 м²</div>
                <div class="text-muted">учебных площадей</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number">8+</div>
                <div class="text-muted">специальностей СПО</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-number">2015</div>
                <div class="text-muted">год образования</div>
            </div>
        </div>

        <div class="text-center small text-muted mt-4">
            Рекомендация: Для самой актуальной информации о приёме на 2026/2027 учебный год обращайтесь в приёмную комиссию или на официальный сайт <a href="https://btpit.obrvrn.ru/" class="myA fw-semibold">btpit.obrvrn.ru</a>
        </div>
    </section>
@endsection

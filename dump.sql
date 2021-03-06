INSERT INTO `lksft`.`users` (`id`, `lastName`, `firstName`, `middleName`, `email`, `phone`, `password`, `passwordUntil`, `link_1s`, `remember_token`, `created_at`, `updated_at`) VALUES 
(1, 'Иванов', 'Иван', 'Иванович', 'abs@dhs.ru', '+7(999) 99-99-91', 'abcdef', '2018-05-14', NULL, NULL, NULL, NULL), 
(2, 'Сидоров', 'Сергей', 'Петрович', 'dssa@dhs.ru', '+7(999) 99-99-92', 'abcdef', '2018-05-14', NULL, NULL, NULL, NULL), 
(3, 'Капустин', 'Иван', 'Федорович', 'rty@dhs.ru', '+7(999) 99-99-93', 'abcdef', '2018-05-14', NULL, NULL, NULL, NULL), 
(4, 'Малкова', 'Светлана', 'Анатольевна', 'ssdf@dhs.ru', '+7(999) 99-99-94', 'abcdef', '2018-05-14', NULL, NULL, NULL, NULL); 


INSERT INTO `lksft`.`counters` (`id`, `name`, `address`,`INN`, `KPP`,`requisites`, `link_1s`, `counterparty_id`) VALUES 
(1, 'Контрагент 1', 'Адрес контрагента 1','111111111','11111', 'Реквизиты контрагента 1', NULL, NULL), 
(2, 'Контрагент 2', 'Адрес контрагента 2', '222222222','22222', 'Реквизиты контрагента 2', NULL, NULL); 


INSERT INTO `lksft`.`cooperations` (`id`, `contract_number`, `contract_period`, `monthly_min_volume`, `monthly_max_volume`, `delayed_payment`, `currency`, `description`, `bonus`, `link_1s`, `counter_id`, `created_at`, `updated_at`) VALUES 
(1, '12345', '2018-05-23', '10', '50', '1', 'рубли', 'Условия сотрудничества 1 актуальные', 'нет', NULL, '1', NULL, NULL), 
(2, '12345', '2018-05-14', '10', '50', '1', 'рубли', 'Условия сотрудничества 1 просрочены', 'нет', NULL, '1', NULL, NULL), 
(3, '22222', '2018-05-25', '10', '20', '3', 'рубли', 'Условия сотрудничества 2 актуальные', 'нет', NULL, '2', NULL, NULL); 


INSERT INTO `lksft`.`applicators` (`id`, `user_id`, `counter_id`, `cooperation_id`, `link_1s`, `created_at`, `updated_at`) VALUES 
(1, '1', '1', '1', NULL, NULL, NULL), 
(2, '2', '1', '2', NULL, NULL, NULL), 
(3, '3', '2', '3', NULL, NULL, NULL), 
(4, '4', '2', '1', NULL, NULL, NULL); 


INSERT INTO `lksft`.`consigneers` (`id`, `name`, `address`, `INN`, `KPP`, `delivery_time`, `roll_diameter`, `core_diameter`, `link_1s`, `created_at`, `updated_at`, `counter_id`) VALUES 
(1, 'Грузополучатель 1 Контрагента 1', 'Адрес Грузополучателя', '2343423433', '34343434', '2018-05-30', '50', '20', NULL, NULL, NULL, '1'), 
(2, 'Грузополучатель 2 Контрагента 1', 'Адрес Грузополучателя', '3647364736', '4545454', '2018-05-14', '40', '50', NULL, NULL, NULL, '1'), 
(3, 'Грузополучатель 3 Контрагента 1', 'Адрес Грузополучателя', '8923343433', '3343434', '2018-05-30', '50', '20', NULL, NULL, NULL, '1'), 
(4, 'Грузополучатель 1 Контрагента 2', 'Адрес Грузополучателя', '1343423433', '34343434', '2018-05-30', '50', '20', NULL, NULL, NULL, '2'), 
(5, 'Грузополучатель 2 Контрагента 2', 'Адрес Грузополучателя', '2647364736', '4545454', '2018-05-14', '40', '50', NULL, NULL, NULL, '2'), 
(6, 'Грузополучатель 3 Контрагента 2', 'Адрес Грузополучателя', '1923343433', '3343434', '2018-05-30', '50', '20', NULL, NULL, NULL, '2'); 

INSERT INTO `lksft`.`providers` (`id`, `name`, `counter_id`, `link_1s`, `created_at`, `updated_at`) VALUES 
(1, 'Поставщик 1', '1', NULL, NULL, NULL), 
(2, 'Поставщик 2', '1', NULL, NULL, NULL), 
(3, 'Поставщик 3', '1', NULL, NULL, NULL), 
(4, 'Поставщик 1', '2', NULL, NULL, NULL), 
(5, 'Поставщик 2', '2', NULL, NULL, NULL), 
(6, 'Поставщик 3', '2', NULL, NULL, NULL); 


INSERT INTO `lksft`.`productranges` (`id`, `brand`, `grammage`, `format`, `price`, `min_lot`, `link_1s`, `created_at`, `updated_at`, `provider_id`) VALUES 
(1, 'L1', '135', '2100', '0', '30', NULL, NULL, NULL, '1'), 
(2, 'L1', '200', '2100', '0', '50', NULL, NULL, NULL, '1'), 
(3, 'L2', '90', '2100', '0', '50', NULL, NULL, NULL, '2'), 
(4, 'L2', '90', '2100', '0', '50', NULL, NULL, NULL, '1'), 
(5, 'L2', '90', '2100', '0', '50', NULL, NULL, NULL, '3'), 
(6, 'L3', '80', '2200', '0', '30', NULL, NULL, NULL, '1'); 

INSERT INTO `lksft`.`deliveries` (`id`, `name`, `created_at`, `updated_at`) VALUES 
(1, 'АВТО', NULL, NULL), 
(2, 'Ж\Д', NULL, NULL), 
(3, 'Авиа', NULL, NULL), 
(4, 'Самовывоз', NULL, NULL); 

INSERT INTO `lksft`.`consigneer_deliveries`
(`id`, `consigneer_id`, `delivery_id`, `price`, `link_1s`, `created_at`, `updated_at`) VALUES 
(1, '1', '1', '10000', NULL, NULL, NULL), 
(2, '1', '2', '30000', NULL, NULL, NULL), 
(3, '1', '3', '40000', NULL, NULL, NULL), 
(4, '1', '4', '50000', NULL, NULL, NULL), 
(5, '2', '2', '35000', NULL, NULL, NULL), 
(6, '2', '3', '40000', NULL, NULL, NULL), 
(7, '2', '4', '45000', NULL, NULL, NULL); 

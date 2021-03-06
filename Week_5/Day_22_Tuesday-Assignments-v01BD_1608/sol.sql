##############SBQ_1
use sakila;
select 
    actor.first_name, actor.last_name, count(*) as movies_count
from
    actor
        inner join
    film_actor ON actor.actor_id = film_actor.actor_id
group by actor.actor_id;
select 
    count_unique_language_id.title, language.name
from
    (select 
        film_id, title, language_id, count(*) as langauge_count
    from
        film
    where
        film.release_year = '2006'
    group by film.language_id) as count_unique_language_id,
    language
where
    count_unique_language_id.language_id = language.language_id
limit 3;
select 
    country.country, count(*) as total
from
    customer,
    address,
    city,
    country
where
    customer.address_id = address.address_id
        AND city.city_id = address.city_id
        AND city.country_id = country.country_id
group by country.country_id
order by total desc
limit 3;
SELECT 
    address2
FROM
    sakila.address
where
    address2 != ''
order by address2;
SELECT 
    actor.first_name,
    actor.last_name,
    actor_ids_of_searched_films.release_year
FROM
    actor,
    (SELECT 
        films_fit_search.release_year, film_actor.actor_id
    from
        film_actor, (SELECT 
        film_id, release_year
    FROM
        film
    WHERE
        ucase(description) LIKE '%SHARK%'
            AND ucase(description) LIKE '%CROCODILE%') as films_fit_search
    WHERE
        films_fit_search.film_id = film_actor.film_id) as actor_ids_of_searched_films
WHERE
    actor.actor_id = actor_ids_of_searched_films.actor_id
order by actor_ids_of_searched_films.release_year;

SELECT 
    *
FROM
    (select 
        category.name, films_count
    from
        category, (select 
        category_id, count(*) as films_count
    from
        film_category
    group by category_id) as counted_unique_group_id
    where
        films_count >= 55 AND films_count <= 65
            AND category.category_id = counted_unique_group_id.category_id
    ORDER BY films_count DESC) as Q1 
UNION ALL SELECT 
    *
FROM
    (select 
        category_id, count(*) as films_count
    from
        film_category
    group by category_id
    order by films_count DESC
    limit 1) AS Q2
WHERE
    NOT EXISTS( select 
            films_count
        from
            (select 
                category_id, count(*) as films_count
            from
                film_category
            group by category_id) as counted_unique_group_id
        where
            films_count >= 55 AND films_count <= 65);


SELECT 
    first_name, last_name
FROM
    actor
WHERE
    first_name = (SELECT 
            first_name
        FROM
            actor
        WHERE
            actor_id = '8')
        AND actor_id != '8' 
UNION SELECT 
    first_name, last_name
FROM
    customer
WHERE
    first_name = (SELECT 
            first_name
        FROM
            actor
        WHERE
            actor_id = '8');
select 
    *
from
    (SELECT 
        *, Count(*) as total
    from
        (select 
        inventory.store_id,
            Rentals.rental_year,
            Rentals.rental_month
    FROM
        inventory, (SELECT 
        inventory_id,
            year(rental_date) as rental_year,
            month(rental_date) as rental_month
    FROM
        rental) as Rentals
    where
        Rentals.inventory_id = inventory.inventory_id) as month_year_store
    group by store_id , rental_year , rental_month) as data_with_total
        join
    (select 
        avg(F.total) as average
    from
        (SELECT 
        *, Count(*) as total
    from
        (select 
        inventory.store_id,
            Rentals.rental_year,
            Rentals.rental_month
    FROM
        inventory, (SELECT 
        inventory_id,
            year(rental_date) as rental_year,
            month(rental_date) as rental_month
    FROM
        rental) as Rentals
    where
        Rentals.inventory_id = inventory.inventory_id) as month_year_store
    group by store_id , rental_year , rental_month) as F) as data_with_average;

SELECT 
    customer.first_name,
    customer.last_name,
    Rents_per_customer.year,
    Rents_per_customer.films_per_year
FROM
    customer,
    (select 
        year(rental_date) as year,
            customer_id,
            count(*) as films_per_year
    from
        rental
    group by customer_id , year
    order by films_per_year desc
    limit 3) as Rents_per_customer
where
    customer.customer_id = Rents_per_customer.customer_id;

 


 

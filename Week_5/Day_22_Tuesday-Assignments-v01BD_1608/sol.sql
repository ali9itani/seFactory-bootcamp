use sakila;
select 
    actor.first_name, actor.last_name, count(*) as movies_count
from
    actor
        inner join
    film_actor ON actor.actor_id = film_actor.actor_id
group by actor.actor_id;
 
select 
    f.title, l.name
from
    (select 
        film_id, title, language_id, count(*) as langauge_count
    from
        film
    where
        film.release_year = '2006'
    group by film.language_id) as f,
    language as l
where
    f.language_id = l.language_id
limit 3;

select 
    country.country, count(*) as total
from
    customer as c,
    address as a,
    city,
    country
where
    c.address_id = a.address_id
        AND city.city_id = a.city_id
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
##############SBQ_5
SELECT 
    A.first_name, A.last_name, N.release_year
FROM
    actor as A,
    (SELECT 
        F.release_year, film_actor.actor_id
    from
        film_actor, (SELECT 
        film_id, release_year
    FROM
        film
    WHERE
        ucase(description) LIKE '%SHARK%'
            OR ucase(description) LIKE '%CROCODILE%') as F
    WHERE
        F.film_id = film_actor.film_id) as N
WHERE
    A.actor_id = N.actor_id
order by N.release_year

#########################SBQ_6
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
    group by category_id) as f_c
    where
        films_count >= 55 AND films_count <= 65
            AND category.category_id = f_c.category_id
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
    limit 3) AS Q2
WHERE
    NOT EXISTS( select 
            films_count
        from
            (select 
                category_id, count(*) as films_count
            from
                film_category
            group by category_id) as f_c
        where
            films_count >= 55 AND films_count <= 65)


#########################SBQ_7
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
UNION
SELECT 
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
        I.store_id, R.rental_year, R.rental_month
    FROM
        inventory as I, (SELECT 
        inventory_id,
            year(rental_date) as rental_year,
            month(rental_date) as rental_month
    FROM
        rental) as R
    where
        R.inventory_id = I.inventory_id) as A
    group by store_id , rental_year , rental_month) as CO
        join
    (select 
        avg(F.total) as average
    from
        (SELECT 
        *, Count(*) as total
    from
        (select 
        I.store_id, R.rental_year, R.rental_month
    FROM
        inventory as I, (SELECT 
        inventory_id,
            year(rental_date) as rental_year,
            month(rental_date) as rental_month
    FROM
        rental) as R
    where
        R.inventory_id = I.inventory_id) as A
    group by store_id , rental_year , rental_month) as F) as AV;



SELECT 
    C.first_name, C.last_name, R.year, R.films_per_year
FROM
    customer as C,
    (select 
        year(rental_date) as year,
            customer_id,
            count(*) as films_per_year
    from
        rental
    group by customer_id , year
    order by films_per_year desc
    limit 3) as R
where
    C.customer_id = R.customer_id;

 
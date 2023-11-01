1. Выборки пользователей, у которых количество постов больше, чем у пользователя их пригласившего.
```postgresql
SELECT u.*
FROM users u
         JOIN users inviter ON u.invited_by_user_id = inviter.id
WHERE u.posts_qty > inviter.posts_qty;
```

2. Выборки пользователей, имеющих максимальное количество постов в своей группе.
```postgresql
WITH MaxPostsPerGroup AS (
    SELECT group_id, MAX(posts_qty) AS max_posts
    FROM users
    GROUP BY group_id
)

SELECT u.*
FROM users u
JOIN MaxPostsPerGroup mpg ON u.group_id = mpg.group_id
WHERE u.posts_qty = mpg.max_posts;
```

3. Выборки групп, количество пользователей в которых превышает 10000.
```postgresql
SELECT g.*
FROM groups g
JOIN (
    SELECT group_id, COUNT(*) AS user_count
    FROM users
    GROUP BY group_id
    HAVING COUNT(*) > 10000
) group_counts ON g.id = group_counts.group_id;

```
4. Выборки пользователей, у которых пригласивший их пользователь из другой группы.
```postgresql
SELECT u.*
FROM users u
JOIN users inviter ON u.invited_by_user_id = inviter.id
WHERE u.group_id <> inviter.group_id;
```
5. Выборки групп с максимальным количеством постов у пользователей.
```postgresql
WITH GroupPostCounts AS (
    SELECT g.id AS group_id, SUM(u.posts_qty) AS total_posts
    FROM groups g
             JOIN users u ON g.id = u.group_id
    GROUP BY g.id
)

SELECT g.id, g.name
FROM groups g
         JOIN (
    SELECT group_id, MAX(total_posts) AS max_posts
    FROM GroupPostCounts
    GROUP BY group_id
) max_group_posts ON g.id = max_group_posts.group_id;
```
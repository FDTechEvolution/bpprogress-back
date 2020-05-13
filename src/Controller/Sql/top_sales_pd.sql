select p.*,COALESCE(sum(line.amount),0) as salesamt,img.image
from 
	products p 
    left join order_lines line on p.id = line.product_id 
    left join (
		select pim.product_id,im.fullpath as image  from product_images pim join images im on pim.image_id = im.id where pim.type='DEFAULT'  group by pim.product_id 
    ) as img on p.id = img.product_id 
group by p.id 
order by salesamt DESC 
limit 10 

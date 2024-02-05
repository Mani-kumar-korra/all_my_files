from PIL import Image

def change_color(input_image_path, output_image_path, target_color):
    # Open the image
    image = Image.open(input_image_path)

    # Convert the image to RGBA mode if it's not already
    image = image.convert('RGBA')

    # Get the image data
    data = image.getdata()

    # Create a new list to store the modified pixel data
    new_data = []

    # Iterate over each pixel and change its color
    for item in data:
        # Check if the pixel color is close to the target color
        if item[:3] == target_color:
            # Change the color to your desired color
            new_data.append((255, 0, 0, item[3]))  # In this example, changing to red (255, 0, 0)
        else:
            new_data.append(item)

    # Create a new image with the modified pixel data
    new_image = Image.new('RGBA', image.size)
    new_image.putdata(new_data)

    # Save the new image
    new_image.save(output_image_path)

# Example usage
input_path = 'newpattress.png'
output_path = 'image.jpg'
target_color = (255, 255, 255)  # Specify the color you want to change

change_color(input_path, output_path, target_color)

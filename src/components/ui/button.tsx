import * as React from "react"
import { cva, type VariantProps } from "class-variance-authority"
import { cn } from "@/lib/utils"

const buttonVariants = cva(
  "inline-flex items-center justify-center whitespace-nowrap rounded-md text-base font-medium ring-offset-neutral-50 transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50",
  {
    variants: {
      variant: {
        default: "bg-primary-500 text-white hover:bg-primary-600 active:bg-primary-700",
        secondary: "bg-secondary-500 text-white hover:bg-secondary-600 active:bg-secondary-700",
        accent: "bg-accent-500 text-white hover:bg-accent-600 active:bg-accent-700",
        outline: "border-2 border-primary-500 text-primary-500 hover:bg-primary-50 active:bg-primary-100",
        ghost: "text-primary-500 hover:bg-neutral-100 active:bg-neutral-200",
        link: "text-primary-500 underline-offset-4 hover:underline",
      },
      size: {
        sm: "h-9 px-3 text-sm",
        md: "h-10 px-4 py-2",
        lg: "h-12 px-6 py-3 text-lg",
        icon: "h-10 w-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "md",
    },
  }
)

export interface ButtonProps
  extends React.ButtonHTMLAttributes<HTMLButtonElement>,
    VariantProps<typeof buttonVariants> {
  asChild?: boolean;
}

const Button = React.forwardRef<HTMLButtonElement, ButtonProps>(
  ({ className, variant, size, asChild, children, ...props }, ref) => {
    // If asChild is true, render the first child with the button className
    if (asChild && React.isValidElement(children)) {
      const childElement = children as React.ReactElement<any>
      return React.cloneElement(childElement, {
        className: cn(buttonVariants({ variant, size }), className, childElement.props.className),
        ...props,
      })
    }
    
    return (
      <button
        className={cn(buttonVariants({ variant, size, className }))}
        ref={ref}
        {...props}
      >
        {children}
      </button>
    )
  }
)
Button.displayName = "Button"

export { Button, buttonVariants }
